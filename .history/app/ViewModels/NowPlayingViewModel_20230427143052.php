<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class NowPlayingViewModel extends ViewModel
{
    protected $nowPlayingMovies;
    protected $genresList;


    public function __construct($nowPlayingMovies, $genresList)
    {
        $this->nowPlayingMovies = $nowPlayingMovies;
        $this->genresList = $genresList;
    }


    public function nowPlayingMovies(){
        
        // Change value before pass to View
        $newMovies =  array_map(function($movie){
            // id => genre
            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function($value){
                return [$value => $this->genresList()->get($value)];
            })->implode(', ');

            // Change value
            $movie['poster_path'] = 'https://image.tmdb.org/t/p/w500'.$movie['poster_path'];
            $movie['vote_average'] = $movie['vote_average']*10 . "%";
            $movie['release_date'] = isset($movie['release_date'])
                ? \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y')
                : 'unknown';
            $movie['genres'] = $genresFormatted;
            return collect($movie)->only([
                'id', 'poster_path', 'title', 'vote_average', 'overview', 'release_date', 'genres', 'genre_ids'
            ]);
        }, $this->nowPlayingMovies);
        
        return $newMovies;
    }


    public function genresList(){
        // id => genre (map)
        return collect($this->genresList)->mapWithKeys(function ($genresList){
            return [$genresList['id'] => $genresList['name']];
        });
    }
}
