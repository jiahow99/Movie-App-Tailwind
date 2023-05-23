<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class CategoryViewModel extends ViewModel
{
    public $type;
    public $category;
    public $categoryName;
    public $movies;
    public $genresList;
    public $filterType;
    public $filterData;
    public $chosen;

    public function __construct($type, $category, $moviesByCategory, $genresList, $filterType, $filterData=null, $chosen=null)
    {
        $this->type = $type;
        $this->category = $category;
        $this->movies = $moviesByCategory;
        $this->genresList = $genresList;
        $this->filterType = $filterType;
        $this->filterData = $filterData;
        $this->chosen = $chosen;
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
            })->filter()->implode(', ');

            // Change value
            $movie['poster_path'] = $movie['poster_path']
                ? 'https://image.tmdb.org/t/p/w500'.$movie['poster_path']
                : asset('image/movie_placeholder.jpg');

            $movie['vote_average'] = $movie['vote_average']*10 . "%";
            
            $movie['release_date'] = isset($movie['release_date'])
                ? \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y')
                : 'To be confirmed';

            $movie['first_air_date'] = isset($movie['first_air_date'])
                ? \Carbon\Carbon::parse($movie['first_air_date'])->format('M d, Y')
                : 'To be confirmed';

            $movie['genres'] = $genresFormatted;

            return collect($movie)->only([
                'id', 'poster_path', 'title', 'vote_average', 'overview', 'release_date', 'genres', 'genre_ids', 'first_air_date', 'name'
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

            case 'trending':
                $this->categoryName = 'Trending';
                break;
            default:
                $this->categoryName = $this->category;
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

}
