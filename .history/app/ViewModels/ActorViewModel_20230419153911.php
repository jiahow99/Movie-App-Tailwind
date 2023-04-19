<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ActorViewModel extends ViewModel
{
    public $actor;
    public $credits;


    public function __construct($actor, $credits)
    {
        $this->actor = $actor;
        $this->credits = $credits;
    }

    
    public function actor(){
        // Format data
        $formattedActor = array_replace($this->actor, [
            'birthday' => Carbon::parse($this->actor['birthday'])->format('M d, Y'),
            'age' => Carbon::parse($this->actor['birthday'])->age,
            'profile_path' => $this->actor['profile_path']
            ? 'https://image.tmdb.org/t/p/w500/' . $this->actor['profile_path']
            : asset('image/avatar-placeholder.png'),
        ]);

        return collect($formattedActor)->dump();
    }


    public function credits(){

        // Format data
        $newCastArray = array_map(function($cast){

            $external_ids = $cast['external_ids'] ;

            $cast['facebook_id'] = isset($external_ids['facebook_id']) ?;
            $cast['poster_path'] = 'https://image.tmdb.org/t/p/w500/' . $cast['poster_path'];
            $cast['title'] = isset($cast['title']) ? $cast['title'] : 'Untitled';
            
            return collect($cast)->only(['title', 'poster_path']);

        }, $this->credits);

        // return collect($this->credits)->only(['poster_path', 'title'])->dump();
        return collect($newCastArray)->dump();
    }
}
