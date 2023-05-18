<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MovieApiService;

class TvController extends Controller
{
    /**
     * Display all Tv Series.
     */
    public function index(Request $request, MovieApiService $movieApi)
    {
        $popularTv = $movieApi->fetchCategoryTv('popular', 2);

        $viewModel = new
        
        // return view('tv.index');
    }
}
