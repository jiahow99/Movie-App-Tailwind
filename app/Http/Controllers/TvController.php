<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\TvsViewModel;
use App\Services\MovieApiService;
use App\ViewModels\MoviesViewModel;
use App\ViewModels\CategoryViewModel;
use App\ViewModels\EpisodeViewModel;
use App\ViewModels\SeasonViewModel;
use App\ViewModels\TvViewModel;

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

        $genresList = $movieApi->fetchGenres('tv');

        $filterData['regions'] = $movieApi->fetchRegions();

        $viewModel = new TvsViewModel($trendingTv, $topRatedTv, $popularTv, $genresList, $filterData);

        return view('tv.index', $viewModel);
    }


    /**
     * Display the specified tv
     */
    public function show(MovieApiService $movieApi, string $id)
    {
        // Fetch movie
        $tv = $movieApi->fetchTv($id, 'images', 'videos', 'credits');
        
        // Fetch all genres
        $genresList = $movieApi->fetchGenres('tv');
        
        // View model format data before passing into view
        $viewModel = new TvViewModel($tv, $genresList);

        return view('tv.show', $viewModel);
    }


    /**
     * Fetch movies by categories
     * [ 'Now Playing' , 'Top Rated' , 'Popular' ]
     */
    public function category(MovieApiService $movieApi, string $category, int $page=1)
    {
        if($page == 1)
        {
            // For index page
            $results = ($category=='trending')
                ? $movieApi->fetchTrending('tv', 2)
                : $movieApi->fetchCategoryTv($category, 2);     
                
            $tvByCategory = array_slice($results, 0, 20);
        }else {
            // For category page
            $tvByCategory = ($category=='trending')
                ? $movieApi->fetchTrending('tv', 0, $page)
                : $movieApi->fetchCategoryTv($category, 0, $page);    
        }

        // Fetch genres
        $genresList = $movieApi->fetchGenres('tv');

        $pageType = 'category';

        // View model
        $viewModel = new CategoryViewModel('tv', $category, $tvByCategory, $genresList, $pageType);

        return view('tv.category', $viewModel);
    }


    /**
     * Fetch tv by Region
     */
    public function tvByRegion(MovieApiService $movieApi, string $region, $page=1)
    {
        // Get filter data if have
        $filterInput = request()->except('region');
        
        // Get chosen filter
        $chosen['year'] = $filterInput['year'] ?? null ;
        $chosen['genre'] = $filterInput['genre'] ?? null ;

        // Fetch movies by Region
        $moviesByRegion = $movieApi->discover('tv', $region, $page, $chosen);
        
        // Fetch all genres
        $genresList = $movieApi->fetchGenres('movie');
        
        // Fetch all filter data
        $filterData['regions'] = $movieApi->fetchRegions();
        $filterData['years'] = $movieApi->fetchYears();
        $filterData['genres'] = $movieApi->fetchGenres('movie');

        $pageType = 'region';

        // View model
        $viewModel = new CategoryViewModel('tv', $region, $moviesByRegion, $genresList, $pageType, $filterData, $chosen);

        return view('tv.category', $viewModel);
    }


    /**
     * Fetch tv season
     */
    public function season(MovieApiService $movieApi, string $tvId, string $seasonId)
    {
        // Fetch tv
        $tv = $movieApi->fetchTv($tvId);

        // Fetch season
        $season = $movieApi->fetchSeason($tvId, $seasonId);
        
        // View model
        $viewModel = new SeasonViewModel($tv, $season);

        return view('tv.season', $viewModel);
    }


    /**
     * Fetch tv season
     */
    public function episode(MovieApiService $movieApi, string $tvId, string $seasonId, string $episode)
    {
        // Fetch episode
        $episode = $movieApi->fetchEpisode($tvId, $seasonId, $episode);

        // Fetch season
        $season = $movieApi->fetchSeason($tvId, $seasonId);
        
        // View model
        $viewModel = new EpisodeViewModel($season, $episode, $tvId);

        return view('tv.episode', $viewModel);
    }


}
