<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BooksController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/v1/books', [BooksController::class, 'index']);
Route::get('/v1/books/{book}', [BooksController::class, 'show']);

//Routes for BookComponent
Route::get('book/{slug}', [BooksController::class, 'showBook']);
Route::post('review', [BooksController::class, 'createReview']);