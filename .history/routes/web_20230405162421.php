<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movie.show');


// Route::view('/swiper')
Route::view('/swiper', 'swiper');
Route::view('/swiper2', 'indexS');