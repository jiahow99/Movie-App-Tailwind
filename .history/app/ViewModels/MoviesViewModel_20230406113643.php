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
        return array_map(function($movie){
            $movie['poster_path'] = '123';
            $movie['vote_average'] = '123';
            $movie['release_date'] = '123';

            return $movie;
        }, $this->popularMovies);
    }
}


