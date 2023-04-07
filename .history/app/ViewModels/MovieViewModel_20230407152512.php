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

    public function movie(){
        // Change value before pass to View
        dump(1);
    }
}
