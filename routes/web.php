<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TvController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\Auth\LoginController;

Auth::routes([
    'verify' => true
]);

// Route::middleware(['verified'])->group(function () {
//     Route::get('/', [MovieController::class, 'index'])->name('movies.index');
// });

/******************************** Socialite Auth ********************************/
// Github Login
Route::get('/login/github', [LoginController::class, 'github'])->name('github.login');
Route::get('/login/github/redirect', [LoginController::class, 'githubRedirect']);

// Google Login 
Route::get('/login/google', [LoginController::class, 'google'])->name('google.login');
Route::get('/login/google/redirect', [LoginController::class, 'googleRedirect']);

// Facebook Login (require SSL)
Route::get('/login/facebook', [LoginController::class, 'facebook'])->name('facebook.login');
Route::get('/login/facebook/redirect', [LoginController::class, 'facebookRedirect']);


/******************************** Public Route ********************************/
// Movies
Route::get('/', [MovieController::class, 'index'])->name('movies.index');

// Single movie
Route::get('/movies/movie/{movie}', [MovieController::class, 'show'])->name('movie.show');

// Movies by Category
Route::get('/movies/{category}', [MovieController::class, 'category'])->name('movies.category');
Route::get('/movies/{category}/page/{page?}', [MovieController::class, 'category']);

// Movies by Region
Route::get('/movies/region/{region}', [MovieController::class, 'moviesByRegion'])->name('movies.region');
Route::get('/movies/region/{region}/page/{page}', [MovieController::class, 'moviesByRegion']);


Route::middleware(['auth', 'auth.api'])->group(function () {
    Route::post('/movie/{movie}/rating/{action}', [MovieController::class, 'rateMovie'])->name('movie.rate');
    Route::post('/tv/{tv}/rating/{action}', [TvController::class, 'rateTv'])->name('tv.rate');
});



// Tv Series
Route::get('/tv', [TvController::class, 'index'])->name('tv.index');

// Single tv
Route::get('/tv/{tv}', [TvController::class, 'show'])->name('tv.show');
Route::get('/tv/{tvId}/season/{season}', [TvController::class, 'season'])->name('tv.season');
Route::get('/tv/{tvId}/season/{season}/episode/{episode}', [TvController::class, 'episode'])->name('tv.episode');

// Tv by Category
Route::get('/tv/list/{category}', [TvController::class, 'category'])->name('tv.category');
Route::get('/tv/{category}/page/{page?}', [TvController::class, 'category']);

// Tv by Region
Route::get('/tv/region/{region}', [TvController::class, 'tvByRegion'])->name('tv.region');
Route::get('/tv/region/{region}/page/{page}', [TvController::class, 'tvByRegion']);


// Actors
Route::get('/actors', [ActorController::class, 'index'])->name('actors.index');
Route::get('/actors/page/{page?}', [ActorController::class, 'index']);
Route::get('/actors/{actor}', [ActorController::class, 'show'])->name('actor.show');


