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
            Redis::set('movies:popular', $json_encoded, 'EX', 1800);  // Expire in 30 mins
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
        if( !Redis::exists("movie:nowPlaying") ){
            

            $nowPlaying = [];

            // Fetch data from API
            for ($page=1; $page <= $max_page; $page++) { 
                $response = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/movie/now_playing?page='.$page);
    
                // Check response OK
                if($response->getStatusCode() === 200){
                    $data = $response->json()['results'];
                    $nowPlaying = array_merge($nowPlaying, $data);
                }else{
                    abort($response->getStatusCode());
                }
            }

            // Store in Redis
            $json_encoded = json_encode( $nowPlaying );
            Redis::set('movie:nowPlaying', $json_encoded , 'EX' , 1800);  // Expire in 30 mins
        }

        // Return data
        $nowPlaying = json_decode( Redis::get('movie:nowPlaying') , true );
        return $nowPlaying;
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
     * Fetch genres.
     */
    public function fetchGenres(){
        $response = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list');

        if($response->getStatusCode() === 200){
            return $response->json()['genres'];
        }
    }

    
    /**
     * Check response OK
     */
    private function checkResponseOk(array $response, int $statusCode){
        if($response->getStatusCode() === 200){
            $data = $response->json()['results'];
            $nowPlaying = array_merge($nowPlaying, $data);
        }else{
            abort($response->getStatusCode());
        }
    }   
}

?>