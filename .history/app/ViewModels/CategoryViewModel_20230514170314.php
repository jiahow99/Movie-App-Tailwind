<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class CategoryViewModel extends ViewModel
{
    public $category;
    public $categoryName;
    public $movies;
    public $genresList;
    public $filterData;
    public $filterInput;
    public $chosenYear;

    public function __construct($category, $moviesByCategory, $genresList, $filterData=null, $filterInput=null)
    {
        $this->category = $category;
        $this->movies = $moviesByCategory;
        $this->genresList = $genresList;
        $this->filterData = $filterData;
        $this->filterInput = $filterInput;
    }


    /**
     * Format movies
     */
    public function movies()
    {
        // Change value before pass to View
        $formattedMovies =  array_map(function($movie){
            // id => genre
            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function($value){
                return [$value => $this->genresList()->get($value)];
            })->implode(', ');

            // Change value
            $movie['poster_path'] = $movie['poster_path']
                ? 'https://image.tmdb.org/t/p/w500'.$movie['poster_path']
                : asset('image/movie_placeholder.jpg');
            $movie['vote_average'] = $movie['vote_average']*10 . "%";
            $movie['release_date'] = isset($movie['release_date'])
                ? \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y')
                : 'unknown';
            $movie['genres'] = $genresFormatted;
            return collect($movie)->only([
                'id', 'poster_path', 'title', 'vote_average', 'overview', 'release_date', 'genres', 'genre_ids'
            ]);
        }, $this->movies);
        
        return $formattedMovies;
    }


    /**
     * Set category name
     */
    public function categoryName()
    {
        switch ($this->category) {
            case 'now_playing':
                $this->categoryName = 'Now Playing';
                break;
            
            case 'top_rated':
                $this->categoryName = 'Top Rated';
                break;

            case 'popular':
                $this->categoryName = 'Popular';
                break;
            default:
                $this->categoryName = '';
                break;
        }

        return $this->categoryName;
    }


    /**
     * Convert genres into format "id" => "name" 
     */
    public function genresList()
    {
        // id => genre (map)
        return collect($this->genresList)->mapWithKeys(function ($genresList){
            return [$genresList['id'] => $genresList['name']];
        });
    }


    /**
     * Get filter 'year'
     */
    public function chosenYear()
    {
        if( !$this->filterInput == null )
        {
            $this->chosenYear = $this->filterInput['year'];
            return $this->chosenYear;
        }
    }

}
