<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;
    public $genresList;
    public $movieCollections;


    public function __construct($movie, $genresList, $movieCollections)
    {
        $this->movie = $movie;
        $this->genresList = $genresList;
        $this->movieCollections = $movieCollections;
    }


    /**
     * Return all genres list from API
     */
    public function genresList(){
        // id => genre (map)
        return collect($this->genresList)->mapWithKeys(function ($genresList){
            return [$genresList['id'] => $genresList['name']];
        });
    }
    

    /**
     * Format movie
     */
    public function movie(){
        // id => genre
        $genresFormatted = collect($this->movie['genres'])->mapWithKeys(function($genres){
            return [ $genres['id'] => $genres['name'] ]; 
        })->implode(', ');


        // Format cast
        $this->movie['credits']['cast'] = array_map(function($cast){

            $cast['profile_path'] = $cast['profile_path']
                ? 'https://image.tmdb.org/t/p/w500'.$cast['profile_path']
                : asset('image/avatar-placeholder.png');
            
            return $cast;

        }, $this->movie['credits']['cast']);


        // Format screenshots
        $this->movie['images']['backdrops'] = collect( $this->movie['images']['backdrops'] )->take(24);


        // Format movie info
        $formatted_movie = collect(array_replace($this->movie, [

            'poster_path' => isset($this->movie['poster_path'])
                ?'https://image.tmdb.org/t/p/w500'.$this->movie['poster_path']
                :asset('/image/avatar-placeholder.jpg'),
                
            'vote_average' => $this->movie['vote_average']*10 . "%",

            'release_year' => Carbon::parse($this->movie['release_date'])->year,

            'release_date' => Carbon::parse($this->movie['release_date'])->format('M d, Y'),

            'genres' => $genresFormatted,

            'youtubeURL' => $this->movie['videos']['results']
                ? $this->movie['videos']['results'][0]['key']
                : null,
        ]));
        // ->only([
        //     'id', 'poster_path', 'title', 'vote_average', 'overview', 'release_date', 'release_year', 'genres', 'genre_ids', 'youtubeURL', 'credits', 'images', 'is_rated'
        // ]);

        return collect($formatted_movie)->dump();
    }


    /**
     * Fetch same collections
     */
    public function movieCollections(){
        if( isset($this->movieCollections) )
        {
            return collect($this->movieCollections)->dump();
        }else{

        }

    }

}
