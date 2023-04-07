<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $popularMovies;
    public $nowPlaying;
    public $genres;


    public function __construct($popularMovies, $nowPlaying, $genres)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlaying = $nowPlaying;
        $this->genres = $genres;
        
        dd($this->popularMovies);
    }


    public function popularMovies(){
        return collect($this->popularMovies)->map(function( $movie ){
            return collect($movie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'],
                'vote_average' => $movie['vote_average']*10 . "%",
                'release_date' => \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y'),
            ]);
        });
        
    }
}
