<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class MovieApiService
{
    /**
     * Fetch trending Tv/Movie.
     */
    public function fetchTrending(string $category, int $max_page = 2, int $page=1)
    {
        $redisCacheName = ($page == 1)
            ? $category.':trending'
            : $category.':trending:page:'.$page;

        if( !Redis::exists($redisCacheName) )
        {
            // For home page
            if( $page == 1 )
            {
                $url = "https://api.themoviedb.org/3/trending/" . $category . "/week";

                $trending = [];

                for ($page=1; $page <= $max_page; $page++) { 

                    $fetchedTrending = $this->fetch($url, $page, 'results', true);

                    $trending = array_merge($trending, $fetchedTrending);
                }

                $this->redisCache($redisCacheName, $trending);
            }
            // For category page
            else{
                $url = "https://api.themoviedb.org/3/trending/" . $category . "/week";

                $trending = $this->fetch($url, $page, 'results', true);

                $this->redisCache($redisCacheName, $trending);
            }

            return $trending;
        }

        // Return results
        return json_decode( Redis::get($redisCacheName), true );
    }

    /**
     * Fetch specific movie.
     */
    public function fetchMovie(string $id, ... $appendToResponse)
    {
        if( !Redis::hexists('movies', $id) )
        {
            // URL for fetching movie
            $movieURL = "https://api.themoviedb.org/3/movie/" . $id . "?append_to_response=" . implode(',', $appendToResponse);

            // Call API
            $movie = $this->fetch($movieURL);

            // Collection ID
            $collectionID = $movie['belongs_to_collection']['id'] ?? null ;
            if( isset($collectionID) )
            {
                // URL for fetching collection
                $collectionURL = "https://api.themoviedb.org/3/collection/" . $collectionID;                

                // Fetch collections of movies then Sort By "Latest"
                $collectionMovies = collect( $this->fetch($collectionURL, 1, 'parts', false) )
                    ->reject(function ($collectionMovie) use ($movie){
                        return $collectionMovie['id'] == $movie['id'];
                    })
                    ->sortByDesc('release_date')->toArray();

                $movie['collection_movies'] = $collectionMovies;
            }

            
            // Store in Redis
            $json_encoded = json_encode( $movie );

            Redis::hset('movies', $id, $json_encoded);  
            Redis::expire('movies', 1800);  // Expire in 30 mins

            return $movie;
        }

        // Return movie
        return json_decode( Redis::hget('movies', $id), true );
    }


    /**
     * Fetch movies by Category.
     * 'Now Playing' , 'Popular' , 'Top Rated'
     */
    public function fetchCategoryMovies(string $category, int $max_page = 2, $page=1)
    { 
        // Replace spacebar with _
        $category = str_replace(' ', '_', $category) ;

        // movies:popular OR movies:popular:page:2
        $redisCacheName = ($page == 1)
            ? 'movies:'.$category
            : 'movies:'.$category.':page:'.$page;

        // API endpoint
        $url = 'https://api.themoviedb.org/3/movie/'.$category ;

        if( !Redis::exists($redisCacheName) )
        {
            if( $page == 1 )
            {
                $movies = [];

                // Fetch data from API
                for ($current_page=1; $current_page <= $max_page; $current_page++) { 
                    $fetchedMovies = $this->fetch($url , $current_page , 'results' , true);
                    $movies = array_merge($movies, $fetchedMovies);
                }
                
                // Store in Redis
                $this->redisCache($redisCacheName, $movies);
            }
            else{
                $movies = $this->fetch($url , $page , 'results' , true);
                
                $this->redisCache($redisCacheName, $movies);
            }

            // Show loading animation
            session()->flash('loader', true);
            return $movies;
        }

        // Return movies from cache
        return json_decode( Redis::get($redisCacheName) , true );        
    }


    /**
     * Fetch specific movie.
     */
    public function fetchTv(string $id, ... $appendToResponse)
    {
        if( !Redis::hexists('tvs', $id) )
        {
            // URL for fetching movie
            $movieURL = "https://api.themoviedb.org/3/tv/" . $id . "?append_to_response=" . implode(',', $appendToResponse);

            // Call API
            $movie = $this->fetch($movieURL);
            
            // Store in Redis
            $json_encoded = json_encode( $movie );

            Redis::hset('tvs', $id, $json_encoded);  
            Redis::expire('tvs', 1800);  // Expire in 30 mins

            return $movie;
        }

        // Return movie
        return json_decode( Redis::hget('tvs', $id), true );
    }


    /**
     * Fetch Tv Series by Category .
     */
    public function fetchCategoryTv(string $category, int $max_page = 2, int $page = 1)
    {
        // Replace spacebar with '_'
        $category = str_replace(' ', '_', $category);

        // tv:popular OR tv:top_rated
        $redisCacheName = ($page==1)
            ? 'tv:'.$category
            : 'tv:'.$category.':page:'.$page;

        // API endpoint
        $url = "https://api.themoviedb.org/3/tv/".$category;

        // Check if stored data before
        if( !Redis::exists($redisCacheName) )
        {
            // For home page
            if( $page == 1 )
            {
                $tv = [];

                // Fetch data from API
                for ($current_page=1; $current_page <= $max_page; $current_page++) { 
                    $fetchedTv = $this->fetch($url, $current_page, 'results', true);
                    $tv = array_merge($tv, $fetchedTv);
                }

                // Store in Redis
                $this->redisCache($redisCacheName, $tv);
            }
            // For category page
            else{
                $tv = $this->fetch($url, $page, 'results', true);

                $this->redisCache($redisCacheName, $tv);
            }

            // Loading animation
            session()->flash('loader', true);

            return $tv;
        }
        
        
        // Return from Redis
        return json_decode( Redis::get($redisCacheName) , true ); 
    }


    /**
     * Fetch movies by Region.
     */
    public function discover(string $type, string $region, $page=1, array $chosen=null)
    {
        // Fetch regions 'code' & 'language'
        $regions = $this->fetchRegions();

        // Get latest date (exclude upcoming movies)
        $nowDate = date('Y-m-d');

        // Fetch region code ('HK','JP')
        $regionCode = $regions[$region]['code'];

        // Fetch region language ('en','zh')
        $regionLanguage = is_array( $regions[$region]['language'] )
            ? implode('|', $regions[$region]['language'])
            : $regions[$region]['language'] ;

        // "movie:HK" or "movie:HK:page:2" 
        if( $page == 1 )
        {
            $redisCacheName = $type.':'.$regionCode;
        }else{
            $redisCacheName = $type.':'.$regionCode.':page:'.$page;
        }

        $baseURL = "https://api.themoviedb.org/3/discover/".$type;
        
        if( isset($chosen) )
        {
            $chosenYear = $chosen['year'] ?? '';
            $chosenGenre = $chosen['genre'] ?? '';

            $formattedURL = ( $type == 'tv' )
                ? $baseURL."?first_air_date_year=".$chosenYear."&page=".$page."&with_genres=".$chosenGenre."&with_origin_country=".$regionCode."&with_original_language=".$regionLanguage
                : $baseURL."?region=".$regionCode."&page=".$page."&primary_release_year=".$chosenYear."&with_genres=".$chosenGenre."&with_original_language=".$regionLanguage ;
            // dd($formattedURL);
            $filterMovies = $this->fetch($formattedURL, $page, 'results');

            return $filterMovies;

        }else{
            $formattedURL =  $baseURL."?region=".$regionCode."&page=".$page."&primary_release_date.lte=".$nowDate."&with_original_language=".$regionLanguage ;

            // Cache fetched movies
            if( !Redis::exists($redisCacheName) )
            {
                $movies = $this->fetch($formattedURL, $page, 'results');
                
                // Cache movies
                $this->redisCache($redisCacheName, $movies);

                // Show loader animation
                session()->flash('loader', true);
                return $movies;
            }

            // Return movies
            return json_decode( Redis::get($redisCacheName), true );
        }   


        
    }
    

    /**
     * Fetch tv season.
     */
    public function fetchSeason(string $tv, string $season)
    {
        $redisCacheName = 'tv:'.$tv.':season:'.$season;

        if( !Redis::exists($redisCacheName) )
        {
            $url = "https://api.themoviedb.org/3/tv/".$tv."/season/".$season."?append_to_response=videos,images,credits";
            
            return $this->fetch($url);
        }


        return json_decode( Redis::get($redisCacheName), true );
    }

    

    /**
     * Fetch genres.
     */
    public function fetchGenres(string $type)
    {
        // genres:tv OR genres:movie
        $redisCacheName = 'genres:'.$type;

        if( !Redis::exists($redisCacheName) ){
            // Fetch data from API
            $genresList = $this->fetch('https://api.themoviedb.org/3/genre/'.$type.'/list', 1, 'genres');
            
            // Store in Redis
            $this->redisCache($redisCacheName, $genresList);
            return $genresList;
        }

        // Return genres list from cache
        return json_decode( Redis::get($redisCacheName), true );
    }


    /**
     * Fetch regions. (only some)
     * All available regions (https://api.themoviedb.org/3/watch/providers/regions)
     */
    public function fetchRegions()
    {
        $redisCacheName = 'regions:list';

        if( !Redis::exists($redisCacheName) ){
            // Regions
            $regions = [
                'Hong Kong' => [
                    'code' => 'HK',
                    'language' => ['zh','cn']
                ],
                'Taiwan' => [
                    'code' => 'TW',
                    'language' => ['zh','cn']
                ],
                'United States' => [
                    'code' => 'US',
                    'language' => 'en'
                ],
                'Japan' => [
                    'code' => 'JP',
                    'language' => ['ja']
                ],
                'Korea' => [
                    'code' => 'KR',
                    'language' => 'ko'
                ],
                'Indonesia' => [
                    'code' => 'ID',
                    'language' => 'id'
                ],
                'Germany' => [
                    'code' => 'DE',
                    'language' => ['de','en']
                ],
                'Thailand' => [
                    'code' => 'TH',
                    'language' => ['th']
                ],
            ];
            
            // Store in Redis
            $this->redisCache($redisCacheName, $regions);
            return $regions;
        }

        // Return genres list
        return json_decode( Redis::get($redisCacheName), true );
    }


    /**
     * Fetch years. (only some)
     */
    public function fetchYears()
    {
        $years = [];
        $currentYear = date('Y');
        $yearsToInclude = 13;

        for ($i=0; $i < $yearsToInclude; $i++) { 
            array_push($years, $currentYear-$i);
        }

        return $years;
    }


    /**
     * Fetch from URL
     */
    private function fetch(string $url , $page = 1, string $resultArray=null, bool $load_more=false )
    {
        // Fetch url with bearer token
        $response = $load_more
            ? Http::withToken(config('services.tmdb.token'))->get( $url.'?page='.$page )
            : Http::withToken(config('services.tmdb.token'))->get( $url ) ;
        
        // Check response OK
        if($response->getStatusCode() === 200)
        {
            return (!is_null($resultArray)) 
                ? $response->json()[$resultArray] 
                : $response->json() ;
        }
        else
        {
            // Abort with Status Code
            abort($response->getStatusCode());
        }
    }
    

    /**
     * Store into Redis
     */
    private function redisCache(string $name, $data, int $expiry_time=1800)
    {
        // Store in Redis
        $json_encoded = json_encode( $data );
        Redis::set($name, $json_encoded, 'EX', $expiry_time);  // Expire in 30 mins
    }



}

?>