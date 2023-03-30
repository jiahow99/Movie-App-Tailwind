<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'index'])->name('movies.index');
Route::get('/movies/{movie}', [UserController::class, 'show'])->name('movies.show');

Route::view('/', 'index');
Route::view('/movie', 'show');
