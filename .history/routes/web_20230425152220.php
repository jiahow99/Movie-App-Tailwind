<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ActorController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;


// Movies
Route::get('/', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/movie/{movie}', [MovieController::class, 'show'])->name('movie.show');
Route::get('/movies/popular', [MovieController::class, 'popular'])->name('movies.popular');
Route::get('/movies/popular/page/{page?}', [MovieController::class, 'popularLoadMore'])->name('movies.popular.load');


// Actors
Route::get('/actors', [ActorController::class, 'index'])->name('actors.index');
Route::get('/actors/page/{page?}', [ActorController::class, 'index']);
Route::get('/actors/{actor}', [ActorController::class, 'show'])->name('actor.show');


Route::get('/redis', function(){
   Redis::set("example_key", "123");
   Redis::expire('example_key', 30);

   Cache::remember("cincai_redis", 30);

});
