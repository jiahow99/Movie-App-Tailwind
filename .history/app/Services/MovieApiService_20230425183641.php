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

        if( !Redis::exists('movies:popular') ){

            $popularMovies = [];

            // Get data
            for ($page=1; $page <= $max_page; $page++) { 
                $response = Http::withToken(config('services.tmdb.token'))
                    ->get('https://api.themoviedb.org/3/movie/popular?page='.$page);
                
                // Check response OK
                if($response->getStatusCode() === 200){
                    $data = $response->json()['results'];
                    $popularMovies = array_merge($popularMovies, $data);
                }else{
                    abort($response->getStatusCode());
                }
            }

            // Store in Redis
            $json_encoded = json_encode( $popularMovies );
            
            Redis::set('movies:popular', $json_encoded, 'EX', 1800);
        }
        
        
        // Return from Redis
        $popularMovies = json_decode( Redis::get('movies:popular') , true );
        return $popularMovies;
    }


    /**
     * Fetch popular movies.
     */
    public function popularLoadMore($page)
    {
        $response = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/movie/popular?page='.$page);

        if($response->getStatusCode() === 200){
            return $response->json()['results'];
        }else{
            abort($response->getStatusCode());
        }

    }


    /**
     * Fetch popular movies.
     */
    public function fetchNowPlaying($max_page = 1)
    {
        if( !Redis::exists("movie:nowPlaying") ){

            $nowPlaying = [];

            // Get data from Api
            for ($page=1; $page <= $max_page; $page++) { 
                $response = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/movie/now_playing?page='.$page);
    
                if($response->getStatusCode() === 200){
                    $data = $response->json()['results'];
                    $nowPlaying = array_merge($nowPlaying, $data);
                }else{
                    abort($response->getStatusCode());
                }
            }


        }

        // If session not been set
        if (!Session::has('nowPlaying')) {

            

            // Set session
            Session::put('nowPlaying', $nowPlaying);
        }

        // Return 20 "Now Playing" movies
        return Session::get('nowPlaying');
    }


    /**
     * Fetch genres.
     */
    public function fetchGenres(){
        $response = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list');

        if($response->getStatusCode() === 200){
            return $response->json()['genres'];
        }
    }
}

?>