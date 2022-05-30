<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/home', [App\Http\Controllers\HomeController::class, 'sendRequest'])->name('home.countries');

//user
Route::get('/profile', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');
Route::get('/edit-profile', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
Route::post('/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');

//Movies
Route::get('/details/{movieId}', [App\Http\Controllers\HomeController::class, 'getMovieDetails'])->name('movie.details');
Route::get('/movie/{movieId}/watch/providers', [App\Http\Controllers\HomeController::class, 'getStreamingProviders'])->name('movie.streamingProviders');
Route::get('/movie/search', [App\Http\Controllers\HomeController::class, 'movieSearch'])->name('movie.search');

//Movie List
Route::get('/movie-list', [App\Http\Controllers\MovieListController::class, 'create'])->name('movielist.create');
Route::post('/movie-list', [App\Http\Controllers\MovieListController::class, 'save'])->name('movielist.save');
Route::get('/movie-list/{id}', [App\Http\Controllers\MovieListController::class, 'detailsList'])->name('movielist.details');
Route::get('/movie-list/add/{id}', [App\Http\Controllers\MovieListController::class, 'addMovie'])->name('movielist.add');
Route::post('/movie-list/add/{id}', [App\Http\Controllers\MovieListController::class, 'addMovieToList'])->name('movielist.addToList');
Route::get('/movie-list/delete/{listId}/{movieId}', [App\Http\Controllers\MovieListController::class, 'deleteMovie'])->name('movie.delete');
Route::get('/movie-list/delete/{id}', [App\Http\Controllers\MovieListController::class, 'deleteList'])->name('movie.deleteList');
