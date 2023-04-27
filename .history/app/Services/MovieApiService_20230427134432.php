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
 
                $response = $this->fetch('https://api.themoviedb.org/3/movie/popular', $page);
                
                // Check response OK
                $popularMovies = $this->getMoviesFromResponse($popularMovies, $response, 200);
            }

            // Show loader animation
            // Session::flash('loader', 'showing');

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

                $response = $this->fetch('https://api.themoviedb.org/3/movie/now_playing', $page);
    
                // Check response OK
                $nowPlaying = $this->getMoviesFromResponse($nowPlaying, $response, 200);
            }

            // Show loader animation
            // Session::flash('loader', 'showing');

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
        // Fetch data from API
        $response = $this->fetch('https://api.themoviedb.org/3/movie/popular', $page);

        // Check response OK
        if($response->getStatusCode() === 200){
            return $response->json()['results'];
        }else{
            abort($response->getStatusCode());
        }
    }


    /**
     * Fetch genres.
     */
    public function fetchGenres()
    {
        if( !Redis::exists('genresList') ){
            // Fetch data from API
            $response = $this->fetch('https://api.themoviedb.org/3/genre/movie/list');
            
            // Check response OK
            if($response->getStatusCode() === 200){
                $genresList = $response->json()['genres'];
            }

            // Show loader animation
            // Session::flash('loader', 'showing');

            // Store in Redis
            $json_encoded = json_encode( $genresList );
            Redis::set('genres:list', $json_encoded, 'EX', 1800);
        }

        // Return genres list
        $genresList = json_decode( Redis::get('genres:list'), true );
        return $genresList;
    }


    /**
     * Check response OK
     */
    private function fetch( $url , $page = 1 )
    {
        $response =  Http::withToken(config('services.tmdb.token'))
            ->get( $url.'?page='.$page );

        return $response;
    }   


    
    /**
     * Check response OK
     */
    private function getMoviesFromResponse( array $movies_array, $response, int $statusCode )
    {
        if($response->getStatusCode() === $statusCode){
            $data = $response->json()['results'];
            return array_merge($movies_array, $data);
        }else{
            abort($response->getStatusCode());
        }
    }   



}

?>