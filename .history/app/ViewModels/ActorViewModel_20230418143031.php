<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class ActorViewModel extends ViewModel
{
    public $actor;


    public function __construct($actor)
    {
        $this->actor = $actor;
    }

    
    public function actor(){
        return $this->actor;
    }
}
