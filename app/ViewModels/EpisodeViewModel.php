<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class EpisodeViewModel extends ViewModel
{
    public $episode;
    public $season;
    public $sameEpisodes;
    public $tv;


    public function __construct($season, $episode, $tvId)
    {
        $this->tv = $tvId;
        $this->season = $season;
        $this->episode = $episode;
    }


    public function episode(){
        return collect(array_replace($this->episode, [
            'still_path' => isset( $this->episode['still_path'] )
                                ? 'https://image.tmdb.org/t/p/w500'.$this->episode['still_path']
                                : asset('image/movie_placeholder.jpg'),

            'air_year' => isset( $this->episode['air_date'] )
                            ? Carbon::parse($this->episode['air_date'])->year
                            : 'To be confirmed',

            'air_date' => isset( $this->episode['air_date'] )
                            ? Carbon::parse($this->episode['air_date'])->format('M d, Y')
                            : 'To be confirmed',

            'youtubeURL' => $this->episode['videos']['results']
                            ? $this->episode['videos']['results'][0]['key']
                            : null,
        ]))->dump();
    }


    public function sameEpisodes(){

        $sameEpisodes = array_map(function( $episode ){

            $episode['still_path'] = $episode['still_path']
                ? 'https://image.tmdb.org/t/p/w500'.$episode['still_path']
                : asset('image/movie_placeholder.jpg');

            return $episode;

        }, $this->season['episodes']);

        return $sameEpisodes;
    }


}
