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
        $formatted_popular_actors = array_map(function($actor){
            
        }, $this->popular_actors);

        return collect($this->popular_actors)->dump();
    }
}
