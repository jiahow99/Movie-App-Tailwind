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

        $trendingTv = $movieApi->fetchTrending('tv', 2);

        $popularTv = $movieApi->fetchCategoryTv('popular', 2);

        $topRatedTv = $movieApi->fetchCategoryTv('top_rated', 2);

        $genresList = $movieApi->fetchGenres();

        $filterData['regions'] = $movieApi->fetchRegions();

        $viewModel = new TvsViewModel($trendingTv, $topRatedTv, $popularTv, $genresList, $filterData);

        return view('tv.index', $viewModel);
    }
}
