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
        return view('tv.index');
    }
}
