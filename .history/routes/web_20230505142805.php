<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;


Auth::routes();



/******************************** Public Route ********************************/
// Movies
Route::get('/', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/movie/{movie}', [MovieController::class, 'show'])->name('movie.show');

// Popular movies
Route::get('/movies/popular', [MovieController::class, 'popular'])->name('movies.popular');
Route::get('/movies/popular/page/{page?}', [MovieController::class, 'popularLoadMore'])->name('movies.popular.load');

Route::middleware(['auth.api'])->group(function () {
    Route::post('/movie/{movie}/rating/{action}', [MovieController::class, 'rate'])->name('movie.rate');
});

// Now Playing movies
Route::get('/movies/nowplaying', [MovieController::class, 'nowPlaying'])->name('movies.nowplaying');
Route::get('/movies/nowplaying/page/{page?}', [MovieController::class, 'nowPlayingLoadMore'])->name('movies.popular.load');


// Actors
Route::get('/actors', [ActorController::class, 'index'])->name('actors.index');
Route::get('/actors/page/{page?}', [ActorController::class, 'index']);
Route::get('/actors/{actor}', [ActorController::class, 'show'])->name('actor.show');


