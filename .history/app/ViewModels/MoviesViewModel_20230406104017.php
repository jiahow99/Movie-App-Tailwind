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
        $this->popularMovies = [12];
        $this->nowPlaying = $nowPlaying;
        $this->genres = $genres;
    }


    // public function popularMovies(){
    //     return
    // }
}
