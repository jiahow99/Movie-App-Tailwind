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
            $movie = $this->fetch($movieURL, 1, null, true);

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

        // Check if stored data before
        if( !Redis::exists('movies:'.$category) ){

            $movies = [];

            // Fetch data from API
            for ($page=1; $page <= $max_page; $page++) { 
                
                $fetchedMovies = $this->fetch('https://api.themoviedb.org/3/movie/'.$category , $page , 'results');

                $movies = array_merge($movies, $fetchedMovies);
            }

            // Store in Redis
            $json_encoded = json_encode( $movies ); 
            Redis::set('movies:'.$category, $json_encoded, 'EX', 1800);  // Expire in 30 mins
        }
        
        // Return from Redis
        $moviesByCategory = json_decode( Redis::get('movies:'.$category) , true ); 

        return $moviesByCategory;
    }


    /**
     * Fetch movies by Region.
     */
    public function fetchRegionMovies(string $region)
    {
        // Fetch regions 'code' & 'language
        $regions = $this->fetchRegions();

        // Fetch region code ('HK','JP')
        $regionCode = $regions[$region]['code'];

        // Fetch region language ('en','zh')
        $regionLanguage = is_array( $regions[$region]['language'] )
            ? implode(',', $regions[$region]['language'])
            : $regions[$region]['language'] ;

        // Example => "movies:popular:page:2" in Redis
        $redisCacheName = 'movies:' . $regionCode;

        // Cache fetched movies
        if( !Redis::exists($redisCacheName) )
        {
            $movies = [];

            // Multiple language
            if( is_array($regions[$region]['language']) )
            {
                $regionLanguage = $regions[$region]['language'];

                foreach ($regionLanguage as $language) {
                    $url = "https://api.themoviedb.org/3/discover/movie?sort_by=release_date.desc&with_original_language=".$language."&region=".$regionCode."&with_production_countries=".$regionCode;
                    
                    $results = $this->fetch($url, 1, 'results');

                    $movies = array_merge($movies, $results);
                }
            }
            
            $json_encoded = json_encode( $movies );

            Redis::set($redisCacheName, $json_encoded, 'EX', 1800);  // Expire in 30 mins
        }

        $moviesByRegion = json_decode( Redis::get($redisCacheName), true );

        return $moviesByRegion;
    }
    
    
    /**
     * Fetch more movies (Popular).
     */
    public function loadMore(string $category, int $page)
    {
        // Example => "movies:popular:page:2" in Redis
        $redisCacheName = 'movies:' . $category . ':page:' . $page;
        
        // Cache fetched movies
        if( !Redis::exists($redisCacheName) )
        {
            $url = "https://api.themoviedb.org/3/movie/" . $category;
            
            $fetchedMovies = $this->fetch($url, $page, 'results');

            $json_encoded = json_encode( $fetchedMovies );

            Redis::set($redisCacheName, $json_encoded, 'EX', 1800);  // Expire in 30 mins
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
        if( !Redis::exists('genres:list') ){
            // Fetch data from API
            $genresList = $this->fetch('https://api.themoviedb.org/3/genre/movie/list', 1, 'genres');
            
            // Store in Redis
            $json_encoded = json_encode( $genresList );
            Redis::set('genres:list', $json_encoded, 'EX', 1800);  // Expire in 30 mins

            // Show loader animation
            Session::flash('loader', 'showing');
        }

        // Return genres list
        $genresList = json_decode( Redis::get('genres:list'), true );

        return $genresList;
    }


    /**
     * Fetch regions. (only some)
     * All available regions (https://api.themoviedb.org/3/watch/providers/regions)
     */
    public function fetchRegions()
    {
        if( !Redis::exists('regions:list') ){
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
                    'code' => ['GB','US'],
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
            $json_encoded = json_encode( $regions );
            Redis::set('regions:list', $json_encoded, 'EX', 1800);  // Expire in 30 mins
        }

        // Return genres list
        $regions = json_decode( Redis::get('regions:list'), true );

        return $regions;
    }


    /**
     * Fetch from URL
     */
    private function fetch(string $url , int $page = 1, string $resultArray=null, bool $appendToResponse=false )
    {
        // Fetch url with bearer token
        $response = $appendToResponse
            ? Http::withToken(config('services.tmdb.token'))->get( $url )
            : Http::withToken(config('services.tmdb.token'))->get( $url.'?page='.$page ) ;


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
    

}

?>