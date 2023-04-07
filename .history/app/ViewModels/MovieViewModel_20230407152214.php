<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;


    public function __construct($movie)
    {
        $this->movie = $movie;
    }

    public movie(){
        return $this->movie;
    }
}
