<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class ActorViewModel extends ViewModel
{
    public $actor;


    public function __construct($popular_actors)
    {
        $this->actor = $actor;
    }

    
    public function actor(){
        return $this->actor;
    }
}
