<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class MovieApiService
{
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
            $movie = $this->fetch($movieURL, 1, null);

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
                    ->sortByDesc('release_date');

                $movie['collection_movies'] = $collectionMovies;
            }

            
            // Store in Redis
            $json_encoded = json_encode( $movie );

            Redis::hset('movies', $id, $json_encoded);  

            Redis::expire('movies', 1800);  // Expire in 30 mins
        }

        // Return movie
        $movie = json_decode( Redis::hget('movies', $id), true );

        return $movie;
    }


    /**
     * Fetch movies by Category.
     * 'Now Playing' , 'Popular' , 'Top Rated'
     */
    public function fetchCategoryMovies(string $category, int $max_page = 2)
    { 
        // Replace spacebar with _
        $category = str_replace(' ', '_', $category) ;

        $redisCacheName = 'movies:'.$category;

        // Check if stored data before
        if( !Redis::exists($redisCacheName) ){

            $movies = [];

            // Fetch data from API
            for ($page=1; $page <= $max_page; $page++) { 
                
                $fetchedMovies = $this->fetch('https://api.themoviedb.org/3/movie/'.$category , $page , 'results' , true);

                $movies = array_merge($movies, $fetchedMovies);
            }

            // Store in Redis
            $this->redisCache($redisCacheName, $movies);
            
            session()->flash('loader', true);
        }
        
        
        // Return from Redis
        $moviesByCategory = json_decode( Redis::get('movies:'.$category) , true ); 

        return $moviesByCategory;
    }


    /**
     * Fetch movies by Region.
     */
    public function fetchRegionMovies(string $region, $page=1, array $filters=null)
    {
        // Fetch regions 'code' & 'language
        $regions = $this->fetchRegions();

        // Get latest date (exclude upcoming movies)
        $nowDate = date('Y-m-d');

        // Fetch region code ('HK','JP')
        $regionCode = $regions[$region]['code'];

        // Fetch region language ('en','zh')
        $regionLanguage = is_array( $regions[$region]['language'] )
            ? implode('|', $regions[$region]['language'])
            : $regions[$region]['language'] ;

        // "movies:HK" or "movies:HK:page:2"
        if( $page == 1 )
        {
            $redisCacheName = 'movies:'.$regionCode;
        }else{
            $redisCacheName = 'movies:'.$regionCode.':page:'.$page;
        }

        // Cache fetched movies
        if( !Redis::exists($redisCacheName) )
        {
            $url = "https://api.themoviedb.org/3/discover/movie?language=en-US&region=".$regionCode."&include_adult=false&include_video=false&page=".$page."&release_date.lte=".$nowDate."&with_original_language=".$regionLanguage ;

            $movies = $this->fetch($url, 1, 'results');
            
            // Cache movies
            $this->redisCache($redisCacheName, $movies);

            session()->flash('loader', true);
        }


        // Return movies
        $moviesByRegion = json_decode( Redis::get($redisCacheName), true );

        // If has filter data "year"/"action_type"
        if( isset($filters) )
        {
            $filteredMovies = collect($moviesByRegion)
                                ->where(function($movie) use ($filters){
                                    
                                })
        }

        return $moviesByRegion;
    }
    
    
    /**
     * Fetch more movies (Popular).
     */
    public function loadMore(string $category, $page=2)
    {
        // API endpoint
        $url = "https://api.themoviedb.org/3/movie/" . $category;

        // Example => "movies:popular:page:2" in Redis
        $redisCacheName = 'movies:' . $category . ':page:' . $page;
        
        // Cache fetched movies
        if( !Redis::exists($redisCacheName) )
        {            
            $fetchedMovies = $this->fetch($url, $page, 'results', true);

            // Cache movies
            $this->redisCache($redisCacheName, $fetchedMovies);
        }

        // Return movies
        $moreMovies =  json_decode( Redis::get($redisCacheName), true );

        return $moreMovies;
    }


    /**
     * Fetch genres.
     */
    public function fetchGenres()
    {
        $redisCacheName = 'genres:list';

        if( !Redis::exists($redisCacheName) ){
            // Fetch data from API
            $genresList = $this->fetch('https://api.themoviedb.org/3/genre/movie/list', 1, 'genres');
            
            // Store in Redis
            $this->redisCache($redisCacheName, $genresList);
        }

        // Return genres list
        $genresList = json_decode( Redis::get($redisCacheName), true );

        return $genresList;
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
        }

        // Return genres list
        $regions = json_decode( Redis::get($redisCacheName), true );

        return $regions;
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