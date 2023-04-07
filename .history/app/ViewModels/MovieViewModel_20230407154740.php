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
        $genresFormatted = collect($this->movie['genres'])->mapWithKeys(function($genres){
            return [ $genres['id'] => $genres['name'] ]; 
        });

        // Format value
        $formattedMovie = collect(array_replace($this->movie, [
            'poster_path' => 'https://image.tmdb.org/t/p/w500'.$this->movie['poster_path'],
            'vote_average' => $this->movie['vote_average']*10 . "%",
            'release_date' => Carbon::parse($this->movie['release_date'])->format('M d, Y'),
            'genres' => $genresFormatted,
        ]))->only([
            'id', 'poster_path', 'title', 'vote_average', 'overview', 'release_date', 'genres', 'genre_ids'
        ]);

        dd($formattedMovie);
    }
}
