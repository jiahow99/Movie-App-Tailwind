<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ActorViewModel extends ViewModel
{
    public $actor;


    public function __construct($actor)
    {
        $this->actor = $actor;
    }

    
    public function actor(){
        // Format data
        $formattedActor = array_replace($this->actor, [
            'birthday' => Carbon::parse($this->actor['birthday'])
        ]);

        return collect($this->actor)->dump();
    }
}
