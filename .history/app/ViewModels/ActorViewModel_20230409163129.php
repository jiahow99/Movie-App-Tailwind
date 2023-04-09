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

    
    public function popular_actors(){
        // return $this->popular_actors;
        dd($this->popular_actors);
    }
}
