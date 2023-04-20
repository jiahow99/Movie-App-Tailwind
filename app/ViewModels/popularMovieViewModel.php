<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class popularMovieViewModel extends ViewModel
{
    public $popularMovies;

    public function __construct($popularMovies)
    {
        $this->popularMovies = $popularMovies;
    }

    
    public function popularMovies(){
        return collect($this->popularMovies)->dump();
        // dd($this->popular_movies);
    }
}
