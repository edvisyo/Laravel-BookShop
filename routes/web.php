<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;

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
Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function() {
        Route::get('/', [AdminController::class, 'index'])->name('admin_page');
    });
    
    Route::group(['middleware' => 'user', 'prefix' => 'user'], function() {
        Route::get('/', [UserController::class, 'index'])->name('user_page');
        Route::delete('/{id}', [UserController::class, 'deleteBook']);
        Route::get('/change-email', [UserController::class, 'updateEmailView'])->name('user_email_update');
        Route::put('/change-email/{id}', [UserController::class, 'updateEmail']);
    });
});

