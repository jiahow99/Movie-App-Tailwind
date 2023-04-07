<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $popularMovies;
    public $nowPlaying;
    public $genresArray;


    public function __construct($popularMovies, $nowPlaying, $genres)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlaying = $nowPlaying;
        $this->genres = $genres;
    }


    public function popularMovies(){
        return $this->formatMovies($this->popularMovies);
    }


    public function nowPlaying(){
        return $this->formatMovies($this->nowPlaying);
    }


    public function genres(){
        // id => genre (map)
        $genres = collect($genresArray)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });

        return $genres;
    }


    private function formatMovies($movie){
        // Change value before pass to View
        $newMovieArray =  array_map(function($movie){
            $movie['poster_path'] = 'https://image.tmdb.org/t/p/w500'.$movie['poster_path'];
            $movie['vote_average'] = $movie['vote_average']*10 . "%";
            $movie['release_date'] = \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y');

            return $movie;
        }, $movie);
        
        // Chunk 10 items each array
        return collect($newMovieArray)->chunk(10);
    }


}


