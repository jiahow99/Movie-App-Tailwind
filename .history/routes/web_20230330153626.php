<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'index'])->name('home');

Route::view('/', 'index');
Route::view('/movie', 'show');
