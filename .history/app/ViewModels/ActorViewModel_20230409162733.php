<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class ActorViewModel extends ViewModel
{
    public $popular_actors;


    public function __construct($popular_actors)
    {
        $this->popular_actors = $popular_actors;
    }
}
