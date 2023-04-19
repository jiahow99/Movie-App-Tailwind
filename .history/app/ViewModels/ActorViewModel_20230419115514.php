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
            'birthday' => Carbon::parse($this->actor['birthday'])->format('M d, Y'),
            'age' => Carbon::parse($this->actor['birthday'])->age,
            'profile_path' => $this->actor['profile_path']
            ? 'https://image.tmdb.org/t/original/' . $this->actor['profile_path']
            : asset('image/avatar-placeholder.png'),
        ]);

        return collect($formattedActor)->dump();
    }
}
