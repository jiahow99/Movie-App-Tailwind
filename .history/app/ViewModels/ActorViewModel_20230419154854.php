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

            // $external_ids = $cast['external_ids'] ?? null ;

            $cast['external_ids']['facebook_id'] = $cast['external_ids']['facebook_id'] 
                ? 'https://www.facebook.com/'.$cast['external_ids']['facebook_id']
                : null;

                $cast['external_ids']['instagram_id'] = $cast['external_ids']['instagram_id'] 
                ? 'https://www.instagram.com/'.$cast['external_ids']['instagram_id']
                : null;

                $cast['external_ids']['twitter_id'] = $cast['external_ids']['twitter_id']
                ? 'https://www.twitter.com/'.$cast['external_ids']['twitter_id']
                : null;

            $cast['poster_path'] = 'https://image.tmdb.org/t/p/w500/' . $cast['poster_path'];
            $cast['title'] = $cast['title']) ? $cast['title'] : 'Untitled';
            
            return collect($cast)->only(['title', 'poster_path', 'external_ids']);

        }, $this->credits);

        // return collect($this->credits)->only(['poster_path', 'title'])->dump();
        return collect($newCastArray)->dump();
    }
}
