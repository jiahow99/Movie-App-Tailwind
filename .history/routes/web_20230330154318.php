<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/movies/{movie}', [UserController::class, 'show'])->name('home');

Route::view('/', 'index');
Route::view('/movie', 'show');
