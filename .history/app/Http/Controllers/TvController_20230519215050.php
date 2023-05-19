<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MovieApiService;
use App\ViewModels\MoviesViewModel;
use App\ViewModels\TvsViewModel;

class TvController extends Controller
{
    /**
     * Display all Tv Series.
     */
    public function index(Request $request, MovieApiService $movieApi)
    {
        // Fetch how many pages of results - 20 result per page
        $max_page = 2;

        $trendingTv = $movieApi->fetchTrending('tv', $max_page);

        $popularTv = $movieApi->fetchCategoryTv('popular', $max_page);

        $topRatedTv = $movieApi->fetchCategoryTv('top_rated', $max_page);

        $genresList = $movieApi->fetchGenres();

        $filterData['regions'] = $movieApi->fetchRegions();

        $viewModel = new TvsViewModel($trendingTv, $topRatedTv, $popularTv, $genresList, $filterData);

        return view('tv.index', $viewModel);
    }


    /**
     * Fetch Tv by Region
     */
    public function tvByRegion(MovieApiService $movieApi, string $region, $page=1)
    {
        // Get user input filter data
        $filterInput = request()->except('region');
        
        // Fetch movies by Region
        $moviesByRegion = $movieApi->fetchRegionMovies($region, $page, $filterInput);
        
        // Fetch all genres
        $genresList = $movieApi->fetchGenres();
        
        // Fetch all regions
        $filterData['regions'] = $movieApi->fetchRegions();
        
        // Fetch all years
        $filterData['years'] = $movieApi->fetchYears();

        $filterType = 'region';

        // View model
        $viewModel = new CategoryViewModel($region, $moviesByRegion, $genresList, $filterType, $filterData, $filterInput);

        return view('movies.category', $viewModel);
    }
}
