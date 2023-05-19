<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MovieApiService;
use App\ViewModels\MovieViewModel;
use App\ViewModels\MoviesViewModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\ViewModels\CategoryViewModel;
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
        
        $popularMovies = $movieApi->fetchCategoryMovies('popular', $max_page);
        
        $nowPlaying = $movieApi->fetchCategoryMovies('now_playing', $max_page);

        $topRated = $movieApi->fetchCategoryMovies('top_rated', $max_page);

        $genresArray = $movieApi->fetchGenres();

        $filterData['regions'] = $movieApi->fetchRegions();

        $viewModel = new MoviesViewModel($popularMovies, $nowPlaying, $topRated, $genresArray, $filterData);

        return view('movies.index', $viewModel);
    }


    /**
     * Display the specified movie
     */
    public function show(MovieApiService $movieApi, string $id)
    {
        // Fetch movie
        $movie = $movieApi->fetchMovie($id, 'images', 'videos', 'credits');
            
        // Fetch all genres
        $genresList = $movieApi->fetchGenres();
        
        // View model format data before passing into view
        $viewModel = new MovieViewModel($movie, $genresList);

        return view('movies.show', $viewModel);
    }


     /**
     * Fetch movies by categories
     * [ 'Now Playing' , 'Top Rated' , 'Popular' ]
     */
    public function category(MovieApiService $movieApi, string $category, int $page=1)
    {
        // Fetch movies by Category (only take 1 page easier for infinite scroll load)
        if($page == 1)
        {
            $moviesByCategory = array_slice($movieApi->fetchCategoryMovies($category, 0, $page), 0, 20);
            
        }else {
            $moviesByCategory = $movieApi->fetchCategoryMovies($category, 0, $page);
        }

        // Fetch all genres
        $genresList = $movieApi->fetchGenres();

        $filterType = 'category';

        // View model
        $viewModel = new CategoryViewModel($category, $moviesByCategory, $genresList, $filterType);

        return view('movies.category', $viewModel);
    }


    /**
     * Fetch movies by Region
     */
    public function moviesByRegion(MovieApiService $movieApi, string $region, $page=1)
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
     * Movies infinite scroll (category page)
     */
    public function loadMore(MovieApiService $movieApi, string $category, $page=1)
    {
        $moreMovies = $movieApi->loadMore($category, $page);

        $genresList = $movieApi->fetchGenres();
        
        $view_model = new CategoryViewModel($category, $moreMovies, $genresList);

        return view('movies.category', $view_model);
    }


    /**
     * Movies infinite scroll (category page)
     */
    // public function loadMoreRegion(MovieApiService $movieApi, string $region, $page = 1)
    // {
    //     $moreMovies = $movieApi->loadMoreRegion($region, $page);

    //     $genresList = $movieApi->fetchGenres();
        
    //     $view_model = new CategoryViewModel($region, $moreMovies, $genresList);

    //     return view('movies.category', $view_model);
    // }


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
