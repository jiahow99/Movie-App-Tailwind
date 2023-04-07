<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;
    public $genresList;


    public function __construct($movie, $genresList)
    {
        $this->movie = $movie;
        $this->genresList = $genresList;
    }


    // All genres 
    public function genresList(){
        // id => genre (map)
        return collect($this->genresList)->mapWithKeys(function ($genresList){
            return [$genresList['id'] => $genresList['name']];
        });
    }
    

    public function movie(){
        // id => genre
        $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function($value){
            return [$value => $this->genresList()->get($value)];
        })->implode(', ');

        $this->movie = [
            'poster_path' => 'https://image.tmdb.org/t/p/w500'.$this->movie['poster_path'],
            'vote_average' => $this->movie['vote_average']*10 . "%",
            'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
            'genres' => $genresFormatted,
        ];

        dump($this->movie);
        // return $this->movie;
    }
}
