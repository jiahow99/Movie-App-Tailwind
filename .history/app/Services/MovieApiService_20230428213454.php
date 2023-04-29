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
    public function fetchPopularMovies($max_page = 1)
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
    public function fetchNowPlaying($max_page = 1)
    {
        if( !Redis::exists("movies:nowPlaying") ){
            
            $nowPlaying = [];

            // Fetch data from API
            for ($page=1; $page <= $max_page; $page++) { 

                $fetchedMovies = $this->fetch('https://api.themoviedb.org/3/movie/now_playing', $page, 'results');
    
                // Check response OK
                $nowPlaying = array_merge($nowPlaying, $fetchedMovies);
            }

            
            // Store in Redis
            $json_encoded = json_encode( $nowPlaying );
            Redis::set('movies:nowPlaying', $json_encoded , 'EX' , 1800);  // Expire in 30 mins

            // Show loader animation
            Session::flash('loader', 'showing');
        }

        // Return data
        $nowPlaying = json_decode( Redis::get('movies:nowPlaying') , true );
        return $nowPlaying;
    }


    
    /**
     * Fetch more movies (Popular).
     */
    public function popularLoadMore($page)
    {
        // Fetch data from API
        $movies = $this->loadMore('https://api.themoviedb.org/3/movie/popular', $page, 'popular');
        
        return $movies;
    }



    /**
     * Fetch more movies (Now Playing).
     */
    public function nowPlayingLoadMore($page)
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
            Redis::set('genres:list', $json_encoded, 'EX', 1800);

            // Show loader animation
            Session::flash('loader', 'showing');
        }

        // Return genres list
        $genresList = json_decode( Redis::get('genres:list'), true );
        return $genresList;
    }



    /**
     * Fetch from URL
     */
    private function fetch($url , $page = 1, $resultArray=null)
    {
        // Fetch url with bearer token
        $response = Http::withToken(config('services.tmdb.token'))
            ->get( $url.'?page='.$page );

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
        $redisCacheName = 'movies:' . $movieCategory . ':page:' . $page;
        
        // Example => "movies:popular:page:2" in Redis
        if( !Redis::exists('movies:'.$movieCategory.':page:'.$page) )
        {
            $fetchedMovies = $this->fetch($url, $page, 'results');
            Redis::set('movies:'.$movieCategory.':page:'.$page)
        }

        // Fetch data from API
        $response = $this->fetch($url, $page, 'results');

        return $response;
    }


}

?>