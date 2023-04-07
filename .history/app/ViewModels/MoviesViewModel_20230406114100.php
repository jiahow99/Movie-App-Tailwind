<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $popularMovies;
    public $nowPlaying;
    public $genres;


    public function __construct($popularMovies, $nowPlaying, $genres)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlaying = $nowPlaying;
        $this->genres = $genres;
    }


    public function popularMovies(){
        // Change value before pass to View
        $newPopularMovies =  array_map(function($movie){
            $movie['poster_path'] = 'https://image.tmdb.org/t/p/w500'.$movie['poster_path'];
            $movie['vote_average'] = $movie['vote_average']*10 . "%";
            $movie['release_date'] = \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y');

            return $movie;
        }, $this->popularMovies);
        
        // Chunk 10 items each array
        return collect($newPopularMovies)->chunk(10);
    }


    public function nowPlaying(){
        // Change value before pass to View
        $newNowPlaying =  array_map(function($movie){
            $movie['poster_path'] = 'https://image.tmdb.org/t/p/w500'.$movie['poster_path'];
            $movie['vote_average'] = $movie['vote_average']*10 . "%";
            $movie['release_date'] = \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y');

            return $movie;
        }, $this->nowPlaying);
        
        // Chunk 10 items each array
        return collect($newNowPlaying)->chunk(10);
    }

    
}


