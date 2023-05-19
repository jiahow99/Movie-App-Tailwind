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
}
