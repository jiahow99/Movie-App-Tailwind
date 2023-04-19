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
        })->implode(', ');

        // Format value
        // $formatted_movie = array_map(function($cast){

        //     $cast['profile_path'] = isset($cast['profile_path'])
        //         ? 'https://image.tmdb.org/t/p/w500/'.$cast['profile_path']
        //         : asset('image/avatar-placeholder.jpg');
            
        //     return $cast;

        // }, $this->movie['credits']['cast']);

        $formattedMovie = collect(array_replace($this->movie, [
            'poster_path' => isset($this->movie['poster_path'])
                ?'https://image.tmdb.org/t/p/w500'.$this->movie['poster_path']
                :asset('/image/avatar-placeholder.jpg'),
            'vote_average' => $this->movie['vote_average']*10 . "%",
            'release_year' => Carbon::parse($this->movie['release_date'])->year,
            'release_date' => Carbon::parse($this->movie['release_date'])->format('M d, Y'),
            'genres' => $genresFormatted,
            'youtubeURL' => $this->movie['videos']['results']
                ?$this->movie['videos']['results'][0]['key']
                : null,
            'credits' => '123',
        ]))->only([
            'id', 'poster_path', 'title', 'vote_average', 'overview', 'release_date', 'release_year', 'genres', 'genre_ids', 'youtubeURL', 'credits', 'images'
        ]);

        return collect($formattedMovie)->dump();
        // dd($this->movie);
    }

}
