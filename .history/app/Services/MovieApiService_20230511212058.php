<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class MovieApiService
{

    /**
     * Fetch popular movies.
     */
    public function fetchMovieByCategory(string $category)
    {
        switch ($category) {
            case 'nowplaying':
                
                break;
            case 'toprated':
                # code...
                break;
            case 'popular':
                # code...
                break;
            
            default:
                # code...
                break;
        }
    }


    /**
     * Fetch popular movies.
     */
    public function fetchPopularMovies(int $max_page = 1)
    {
        // Check if stored data before
        if( !Redis::exists('movies:popular') ){

            $popularMovies = [];

            // Fetch data from API
            for ($page=1; $page <= $max_page; $page++) { 
 
                $fetchedMovies = $this->fetch('https://api.themoviedb.org/3/movie/popular', $page, 'results');
                
                // Check response OK
                $popularMovies = array_merge($popularMovies, $fetchedMovies);
            }

            // Store in Redis
            $json_encoded = json_encode( $popularMovies ); 
            Redis::set('movies:popular', $json_encoded, 'EX', 1800);  // Expire in 30 mins
            
            // Show loader animation
            Session::flash('loader', 'showing');
        }
        
        
        // Return from Redis
        $popularMovies = json_decode( Redis::get('movies:popular') , true ); 

        return $popularMovies;
    }



    /**
     * Fetch popular movies.
     */
    public function fetchNowPlaying(int $max_page = 1)
    {
        if( !Redis::exists("movies:nowplaying") ){
            
            $nowPlaying = [];

            // Fetch data from API
            for ($page=1; $page <= $max_page; $page++) { 

                $fetchedMovies = $this->fetch('https://api.themoviedb.org/3/movie/now_playing', $page, 'results');
    
                // Check response OK
                $nowPlaying = array_merge($nowPlaying, $fetchedMovies);
            }

            
            // Store in Redis
            $json_encoded = json_encode( $nowPlaying );
            Redis::set('movies:nowplaying', $json_encoded , 'EX' , 1800);  // Expire in 30 mins

            // Show loader animation
            Session::flash('loader', 'showing');
        }

        // Return data
        $nowPlaying = json_decode( Redis::get('movies:nowplaying') , true );

        return $nowPlaying;
    }


    
    /**
     * Fetch more movies (Popular).
     */
    public function popularLoadMore(int $page)
    {
        // Fetch data from API
        $movies = $this->loadMore('https://api.themoviedb.org/3/movie/popular', $page, 'popular');
        
        return $movies;
    }



    /**
     * Fetch more movies (Now Playing).
     */
    public function nowPlayingLoadMore(int $page)
    {
        // Fetch data from API
        $movies = $this->loadMore('https://api.themoviedb.org/3/movie/now_playing', $page, 'nowPlaying');
        
        return $movies;
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
     * Fetch genres.
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

    
    
    /**
     * Load more movies (infinite sceolling).
     */
    private function loadMore(string $url, int $page, string $movieCategory)
    {
        // Example => "movies:popular:page:2" in Redis
        $redisCacheName = 'movies:' . $movieCategory . ':page:' . $page;
        
        // Cache fetched movies
        if( !Redis::exists($redisCacheName) )
        {
            $fetchedMovies = $this->fetch($url, $page, 'results');

            $json_encoded = json_encode( $fetchedMovies );

            Redis::set($redisCacheName, $json_encoded, 'EX', 1800);  // Expire in 30 mins
        }

        // Return movies
        $moreMovies =  json_decode( Redis::get($redisCacheName), true );

        return $moreMovies;
    }


}

?>