<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use App\ViewModels\popularMovieViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\MovieApiService;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $movieApi;

    public function index(MovieApiService $movieApi)
    {
        // Fetch how many page
        $max_page = 2;
        
        $popularMovies = $movieApi->fetchPopularMovies($max_page);
        
        $nowPlaying = $movieApi->fetchNowPlaying($max_page);

        $genresArray = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];


        $viewModel = new MoviesViewModel($popularMovies, $nowPlaying, $genresArray);

        return view('movies.index', $viewModel);
    }


    /**
     * Show popular movies
     */
    public function popular(MovieApiService $movieApi)
    {
        $popularMovies = $movieApi->fetchPopularMovies();
        
        $view_model = new popularMovieViewModel($popularMovies);

        return view('movies.popular', $view_model);
    }

    /**
     * Display the specified movie
     */
    public function show(string $id)
    {
        $movie = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=credits,videos,images')
            ->json();
            
        $genresList = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];


        $viewModel = new MovieViewModel($movie, $genresList);

        return view('movies.show', $viewModel);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
