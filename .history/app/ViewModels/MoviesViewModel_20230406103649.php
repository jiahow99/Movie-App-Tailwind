<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $popularMovies;
    public $genresArray;
    public $nowPlaying;
    public $genres;

    public function __construct()
    {
        //
    }
}
