<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class NowPlayingViewModel extends ViewModel
{
    protected $nowPlayingMovies;
    protected $genresList;

    
    public function __construct()
    {
        //
    }
}
