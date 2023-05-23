<?php

namespace App\ViewModels;

use Illuminate\Support\Carbon;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public $tv;
    public $genresList;


    public function __construct($tv, $genresList)
    {
        $this->tv = $tv;
        $this->genresList = $genresList;
    }

    public function tv(){
        // id => genre
        $genresFormatted = collect($this->tv['genres'])->mapWithKeys(function($genres){
            return [ $genres['id'] => $genres['name'] ]; 
        })->filter()->implode(', ');


        // Format cast
        $this->tv['created_by'] = array_map(function($cast){

            $cast['profile_path'] = $cast['profile_path']
                ? 'https://image.tmdb.org/t/p/w500'.$cast['profile_path']
                : asset('image/avatar-placeholder.png');
            
            return $cast;

        }, $this->tv['created_by']);


        // Format cast
        $this->tv['seasons'] = array_map(function($season){

            $season['poster_path'] = $season['poster_path']
                ? 'https://image.tmdb.org/t/p/w500'.$season['poster_path']
                : asset('image/movie_placeholder.png');
            
            return $season;

        }, $this->tv['seasons']);


        // Format tv info
        $formatted_tv = collect(array_replace($this->tv, [

            'poster_path' => isset($this->tv['poster_path'])
                ? 'https://image.tmdb.org/t/p/w500'.$this->tv['poster_path']
                : asset('image/movie_placeholder.jpg'),
                
            'vote_average' => $this->tv['vote_average']*10 . "%",

            'release_year' => Carbon::parse($this->tv['first_air_date'])->year,

            'first_air_date' => Carbon::parse($this->tv['first_air_date'])->format('M d, Y'),

            'genres' => $genresFormatted,

            'youtubeURL' => $this->tv['videos']['results']
                ? $this->tv['videos']['results'][0]['key']
                : null,

        ]))->only([
            'id', 'poster_path', 'name', 'vote_average', 'overview', 'first_air_date', 'release_year', 'genres', 'seasons', 'youtubeURL', 'created_by', 'images', 'is_rated'
        ]);

        return $formatted_tv;
    }
}
