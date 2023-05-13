<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Register
Route::view('/register/test', 'register-test');

/******************************** Public Route ********************************/
// Movies
Route::get('/', [MovieController::class, 'index'])->name('movies.index');

// Single movie
Route::get('/movies/movie/{movie}', [MovieController::class, 'show'])->name('movie.show');

// Movies by Category
Route::get('/movies/{category}', [MovieController::class, 'category'])->name('movies.category');
Route::get('/movies/{category}/page/{page?}', [MovieController::class, 'loadMore']);

// Movies by Region
Route::get('/movies/region/{region}', [MovieController::class, 'moviesByRegion'])->name('movies.region');
Route::get('/movies/region/{region}/page/{page}', [MovieController::class, 'moviesByRegion']);


Route::middleware(['auth', 'auth.api'])->group(function () {
    Route::post('/movie/{movie}/rating/{action}', [MovieController::class, 'rateMovie'])->name('movie.rate');
});

// Actors
Route::get('/actors', [ActorController::class, 'index'])->name('actors.index');
Route::get('/actors/page/{page?}', [ActorController::class, 'index']);
Route::get('/actors/{actor}', [ActorController::class, 'show'])->name('actor.show');


