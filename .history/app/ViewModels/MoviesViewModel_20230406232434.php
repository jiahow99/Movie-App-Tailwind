<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $popularMovies;
    public $nowPlaying;
    public $genresArray;


    public function __construct($popularMovies, $nowPlaying, $genresArray)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlaying = $nowPlaying;
        $this->genresArray = $genresArray;
    }


    public function popularMovies(){
        return $this->formatMovies($this->popularMovies);
    }


    public function nowPlaying(){
        return $this->formatMovies($this->nowPlaying);
    }


    public function genresArray(){
        // id => genre (map)
        return collect($this->genresArray)->mapWithKeys(function ($genresArray){
            return [$genresArray['id'] => $genresArray['name']];
        });
    }


    private function formatMovies($movie){
        // $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function($value){
        //     return [$value => $this->genres()->get($value)];
        // });

        // Change value before pass to View
        $newMovieArray =  array_map(function($movie){
            $movie['poster_path'] = 'https://image.tmdb.org/t/p/w500'.$movie['poster_path'];
            $movie['vote_average'] = $movie['vote_average']*10 . "%";
            $movie['release_date'] = \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y');
            $movie['genres'] = $this->genresArray;
            return $movie;
        }, $movie);
        
        // Chunk 10 items each array
        return collect($newMovieArray)->chunk(10);
    }


}


