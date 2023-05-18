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
        // $popularTv = $movieApi->fetchCategoryTv('popular', 2);

        $topRatedTv = $movieApi->fetchCategoryTv('top_rated', 2);

        // dd($topRatedTv);
        // $viewModel = new TvsViewModel($popularTv);

        // return view('tv.index', $viewModel);
    }
}
