<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class SeasonViewModel extends ViewModel
{
    public $tv;
    public $season;

    public function __construct($tv, $season)
    {
        $this->tv = $tv;
        $this->season = $season;
        // dd($this->season);
    }

    
    public function season()
    {
        // Format actors
        $this->season['credits']['cast'] = array_map(function($cast){
    
            $cast['profile_path'] = $cast['profile_path']
                ? 'https://image.tmdb.org/t/p/w500'.$cast['profile_path']
                : asset('image/avatar-placeholder.png');
            
            return $cast;
    
        }, $this->season['credits']['cast']);


        // Format episodes
        $this->season['episodes'] = array_map(function( $episode ){

            $episode['still_path'] = $episode['still_path']
                ? 'https://image.tmdb.org/t/p/w500'.$episode['still_path']
                : asset('image/movie_placeholder.jpg');

            return $episode;

        }, $this->season['episodes']);


        // Format season
        $new_season = array_replace($this->season, [

            'poster_path' => $this->season['poster_path']
                ? 'https://image.tmdb.org/t/p/w500'.$this->season['poster_path']
                : asset('image/movie_placeholder.jpg'),

            'youtubeURL' => $this->season['videos']['results']
                ? $this->season['videos']['results'][0]['key']
                : null,

            'air_year' => Carbon::parse($this->season['air_date'])->year,

            'air_date' => Carbon::parse($this->season['air_date'])->format('M d, Y'),
        ]);

        return collect($new_season)->dump();
    }

}
