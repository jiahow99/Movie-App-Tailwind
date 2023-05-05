<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MovieApiService;
use App\ViewModels\MovieViewModel;
use App\ViewModels\MoviesViewModel;
use Illuminate\Support\Facades\Auth;
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

        return view('movies.nowPlaying', $view_model);
    }


    /**
     * Display the specified movie
     */
    public function show(MovieApiService $movieApi, string $id)
    {
        $movie = $movieApi->fetchMovie($id, 'images', 'videos', 'credits');
            
        $genresList = $movieApi->fetchGenres();

        $viewModel = new MovieViewModel($movie, $genresList);

        return view('movies.show', $viewModel);
    }


    /**
     * Rate a movie
     */
    public function rateMovie(string $id, string $action)
    {
        $user = Auth::user();

        // Get Session Id
        $data['guest_session_id'] = $user->guest_session_id;

        // Rate good/bad
        switch ($action) {
            case 'good':
                $this->rate($id, 7.5);
                break;
            
            case 'bad':
                $this->rate($id, 2.5);
                break;
        }

        // Return to movie page
        return redirect()->back()->with('Success', 'Thank you for the feedback !');
    }


    /**
     * Rate a specific movie
     */
    private function rate(string $movie_id, int $score)
    {
        // API endpoint
        $url = 'https://api.themoviedb.org/3/movie/'.$movie_id.'/rating';

        // Set rating score into POST data
        $data = ['value' => $score];

        // Post Request to API
        $request = Http::withToken(config('services.tmdb.token'))
            ->post($url, $data);

        dd($request->json());

        // Check response success & update "is_rated"
        if( $request->json()['success'] )
        {
            $movie = json_decode( Redis::hget('movies', $movie_id), true);
            $movie['is_rated'] = ($score > 5) ? 'good' : 'bad';
            $json_encoded = json_encode( $movie );
            Redis::hset('movies', $movie_id, $json_encoded); 

        }else{
            return redirect()->back()->with('Error', 'Error rating this movie. Try relogin');
        }
    }

    
}
