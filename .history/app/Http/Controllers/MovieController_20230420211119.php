<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Initialioze popular movie array
        $popularMovies = [];
        $nowPlaying = [];

        // Get popular movies
        for ($page=1; $page <= 3; $page++) { 
            $response = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/movie/popular?page='.$page);

            if($response->getStatusCode() === 200){
                $data = $response->json()['results'];
                $popularMovies = array_merge($popularMovies, $data);
            }else{
                abort($response->getStatusCode());
            }
        }
        
        // Get now playing movies
        for ($page=1; $page <= 3; $page++) { 
            $response = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/now_playing?page='.$page);

            if($response->getStatusCode() === 200){
                $data = $response->json()['results'];
                $nowPlaying = array_merge($nowPlaying, $data);
            }else{
                abort($response->getStatusCode());
            }
        }

        $genresArray = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];



        $viewModel = new MoviesViewModel($popularMovies, $nowPlaying, $genresArray);

        return view('movies.index', $viewModel);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Display the specified resource.
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
