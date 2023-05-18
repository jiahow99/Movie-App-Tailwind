<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class TvsViewModel extends ViewModel
{
    public $trendingTv;
    public $topRatedTv;
    public $popularTv;
    public $genresList;
    public $filterData;

    public function __construct($trendingTv, $topRatedTv, $popularTv, $genresList, $filterData)
    {
        $this->trendingTv = $trendingTv;
        $this->topRatedTv = $topRatedTv;
        $this->popularTv = $popularTv;
        $this->genresList = $genresList;
        $this->filterData = $filterData;
    }


    /**
     * Format Trending Tv
     */
    public function trendingTv()
    {
        return $this->formatTv( $this->trendingTv );
    }


    /**
     * Format Trending Tv
     */
    public function topRatedTv()
    {
        return $this->formatTv( $this->topRatedTv );
    }


    /**
     * Format Trending Tv
     */
    public function popularTv()
    {
        return $this->formatTv( $this->popularTv );
    }


    /**
     * Map array with genres_id => genres_name
     * '1' => 'action'
     */
    private function genresList(){
        // id => genre (map)
        return collect($this->genresList)->mapWithKeys(function ($genresList){
            return [$genresList['id'] => $genresList['name']];
        });
    }

    
    private function formatTv($tvArray){
        // Change value before pass to View
        $newTvArray =  array_map(function($tv){

            // id => genre
            $genresFormatted = collect($tv['genre_ids'])->mapWithKeys(function($value){
                return [$value => $this->genresList()->get($value)];
            })->filter()->implode(', ');

            $tv['poster_path'] = 'https://image.tmdb.org/t/p/w500'.$tv['poster_path'];
            $tv['vote_average'] = $tv['vote_average']*10 . "%";
            $tv['release_date'] = isset($tv['first_air_date'])
                ? \Carbon\Carbon::parse($tv['first_air_date'])->format('M d, Y')
                : 'To Be Confirmed...';
            $tv['genres'] = $genresFormatted;

            return collect($tv)->only([
                'id', 'poster_path', 'name', 'vote_average', 'release_date', 'genres', 'genre_ids'
            ]);

        }, $tvArray);
        
        // Chunk 20 items each array
        return collect($newTvArray)->chunk(20);
    }
}
