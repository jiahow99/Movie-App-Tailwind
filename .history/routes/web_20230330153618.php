<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'index'])->name('user.index');

Route::view('/', 'index');
Route::view('/movie', 'show');
