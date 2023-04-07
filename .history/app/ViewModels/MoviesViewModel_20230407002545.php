<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $popularMovies;
    public $nowPlaying;
    public $genresList;


    public function __construct($popularMovies, $nowPlaying, $genresList)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlaying = $nowPlaying;
        $this->genresList = $genresList;
    }


    public function popularMovies(){
        return $this->formatMovies($this->popularMovies);
    }


    public function nowPlaying(){
        return $this->formatMovies($this->nowPlaying);
    }


    // All genres 
    public function genresList(){
        // id => genre (map)
        return collect($this->genresList)->mapWithKeys(function ($genresList){
            return [$genresList['id'] => $genresList['name']];
        });
    }


    private function formatMovies($movie){
        // Change value before pass to View
        $newMovieArray =  array_map(function($movie){
            // id => genre
            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function($value){
                return [$value => $this->genresList()->get($value)];
            })->implode(', ');

            $movie['poster_path'] = 'https://image.tmdb.org/t/p/w500'.$movie['poster_path'];
            $movie['vote_average'] = $movie['vote_average']*10 . "%";
            $movie['release_date'] = \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y');
            $movie['genres'] = $genresFormatted;
            return collect($movie)->only([
                'poster_path', 'title', 'vote_average', 'overview', 'release_date', 'genres', 'genre_ids'
            ]);
        }, $movie);
        
        // Chunk 10 items each array
        return collect($newMovieArray)->chunk(10);
    }


}


