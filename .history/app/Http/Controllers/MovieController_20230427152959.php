<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MovieApiService;
use App\ViewModels\MovieViewModel;
use App\ViewModels\MoviesViewModel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use App\ViewModels\NowPlayingViewModel;
use Illuminate\Support\Facades\Session;
use App\ViewModels\popularMoviesViewModel;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $movieApi;

    public function index(Request $request, MovieApiService $movieApi)
    {
        // Fetch how many page
        $max_page = 2;
        
        $popularMovies = $movieApi->fetchPopularMovies($max_page);
        
        $nowPlaying = $movieApi->fetchNowPlaying($max_page);

        $genresArray = $movieApi->fetchGenres();

        $viewModel = new MoviesViewModel($popularMovies, $nowPlaying, $genresArray);

        return view('movies.index', $viewModel);
    }


    /**
     * Show popular movies
     */
    public function popular(MovieApiService $movieApi)
    {        
        $popularMovies =  array_slice($movieApi->fetchPopularMovies(), 0, 20);

        $genresList = $movieApi->fetchGenres();
        
        $view_model = new popularMoviesViewModel($popularMovies, $genresList);

        return view('movies.popular', $view_model);
    }


    /**
     * Popular movies infinite scrolling
     */
    public function popularLoadMore(MovieApiService $movieApi, $page = 1)
    {
        $popularMovies = $movieApi->popularLoadMore( $page );

        $genresList = $movieApi->fetchGenres();
        
        $view_model = new popularMoviesViewModel($popularMovies, $genresList);

        return view('movies.popular', $view_model);
    }


     /**
     * Show Now Playing movies
     */
    public function nowPlaying(MovieApiService $movieApi)
    {        
        $nowPlayingMovies =  array_slice($movieApi->fetchNowPlaying(), 0, 20);

        $genresList = $movieApi->fetchGenres();
        
        $view_model = new NowPlayingViewModel($nowPlayingMovies, $genresList);

        return view('movies.nowPlaying', $view_model);
    }


    /**
     * Now playing movies infinite scrolling
     */
    public function nowPlayingLoadMore(MovieApiService $movieApi, $page = 1)
    {
        $nowPlayingMovies = $movieApi->nowPlayingLoadMore( $page );

        $genresList = $movieApi->fetchGenres();
        
        $view_model = new NowPlayingViewModel($nowPlayingMovies, $genresList);

        dd($nowPlayingMovies);

        return view('movies.nowPlaying', $view_model);
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
