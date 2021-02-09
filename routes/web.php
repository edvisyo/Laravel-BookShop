<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\ReviewsController;

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

Route::resource('/', BooksController::class);
// Route::get('/', [BooksController::class, 'index']);

// Route::get('/', [BooksController::class, 'getBooks']);
Route::get('/book/{slug}', [BooksController::class, 'getSingleBook']);
Route::post('/book', [ReviewsController::class, 'storeBookReview']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
