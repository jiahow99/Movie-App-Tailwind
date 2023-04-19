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
        $external_ids = $this->actor['external_ids'];

        // Read more
        if(str_word_count($this->actor['biography']) > 100){
            $biography_array = explode(" ", $this->actor['biography']);
            $chunks = array_chunk($biography_array, 100);

            $biography = implode(" ", $chunks[0]);
            $read_more = implode(" ", $chunks[1]);
        }else{
            $biography = $this->actor['biography'];
        }

        // Format data
        $formattedActor = array_replace($this->actor, [
            // Social media
            'facebook' => $external_ids['facebook_id']
                ? 'https://www.facebook.com/'.$external_ids['facebook_id']
                : null,

            'instagram' => $external_ids['instagram_id']
                ? 'https://www.instagram.com/'.$external_ids['instagram_id']
                : null,

            'twitter' => $external_ids['twitter_id']
                ? 'https://www.twitter.com/'.$external_ids['twitter_id']
                : null,

            'birthday' => $this->actor['birthday']
                ? Carbon::parse($this->actor['birthday'])->format('M d, Y')
                : 'unknown',

            'age' => $this->actor['birthday']
                ? Carbon::parse($this->actor['birthday'])->age
                : 'unknown',

            'place_of_birth' => $this->actor['place_of_birth']
                ? $this->actor['place_of_birth']
                : 'unknown',

            // Profile image
            'profile_path' => $this->actor['profile_path']
                ? 'https://image.tmdb.org/t/p/w500/' . $this->actor['profile_path']
                : asset('image/avatar-placeholder.png'),

            // Read more
            'biography' => $biography,
            'read_more' => $read_more ?? null,
        ]);


        return collect($formattedActor)->only([
            'biography', 
            'birthday', 
            'id', 
            'name', 
            'place_of_birth', 
            'profile_path', 
            'facebook', 
            'instagram', 
            'twitter', 
            'age', 
            'read_more'
        ]);
    }


    public function credits(){

        // Format data
        $newCastArray = array_map(function($cast){

            $cast['poster_path'] = 'https://image.tmdb.org/t/p/w500/' . $cast['poster_path'];
            $cast['title'] = isset($cast['title']) ? $cast['title'] : 'Untitled';
            
            return collect($cast)->only([
                'title', 
                'poster_path', 
                'facebook', 
                'instagram', 
                'twitter', 
                'id'
            ]);

        }, $this->credits);

        return collect($newCastArray);
    }
}
