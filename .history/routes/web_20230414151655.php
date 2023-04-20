<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ActorController;
use Illuminate\Support\Facades\Route;


// Movies
Route::get('/', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movie.show');


// Actors
Route::get('/actors', [ActorController::class, 'index'])->name('actors.index');
Route::get('/actors/page/{page?}', [ActorController::class, 'index']);
Route::get('/actors/{actor}', [ActorController::class, 'show'])->name('actor.show');


Route::view('/404', 'errors.404');