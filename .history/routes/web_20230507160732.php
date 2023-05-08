<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'verify' => true
]);

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
Route::get('/movies/movie/{movie}', [MovieController::class, 'show'])->name('movie.show');

// Popular movies
Route::get('/movies/popular', [MovieController::class, 'popular'])->name('movies.popular');
Route::get('/movies/popular/page/{page?}', [MovieController::class, 'popularLoadMore'])->name('movies.popular.load');

Route::middleware(['auth', 'auth.api'])->group(function () {
    Route::post('/movie/{movie}/rating/{action}', [MovieController::class, 'rateMovie'])->name('movie.rate');
});

// Now Playing movies
Route::get('/movies/nowplaying', [MovieController::class, 'nowPlaying'])->name('movies.nowplaying');
Route::get('/movies/nowplaying/page/{page?}', [MovieController::class, 'nowPlayingLoadMore'])->name('movies.popular.load');


// Actors
Route::get('/actors', [ActorController::class, 'index'])->name('actors.index');
Route::get('/actors/page/{page?}', [ActorController::class, 'index']);
Route::get('/actors/{actor}', [ActorController::class, 'show'])->name('actor.show');


