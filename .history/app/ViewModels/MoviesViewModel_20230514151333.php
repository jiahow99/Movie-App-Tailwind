<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $popularMovies;
    public $nowPlaying;
    public $topRated;
    public $genresList;
    public $regions;
    public $years;


    public function __construct($popularMovies, $nowPlaying, $topRated, $genresArray, $regions, $years)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlaying = $nowPlaying;
        $this->topRated = $topRated;
        $this->genresList = $genresArray;
        $this->regions = $regions;

    }


    public function popularMovies(){
        return $this->formatMovies($this->popularMovies);
    }


    public function nowPlaying(){
        return $this->formatMovies($this->nowPlaying);
    }


    public function topRated(){
        return $this->formatMovies($this->topRated);
    }


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
            $movie['release_date'] = isset($movie['release_date'])
                ? \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y')
                : 'unknown';
            $movie['genres'] = $genresFormatted;
            return collect($movie)->only([
                'id', 'poster_path', 'title', 'vote_average', 'overview', 'release_date', 'genres', 'genre_ids'
            ]);
        }, $movie);
        
        // Chunk 20 items each array
        return collect($newMovieArray)->chunk(20);
    }


    public function regions(){
        return $this->regions;
    }


}


