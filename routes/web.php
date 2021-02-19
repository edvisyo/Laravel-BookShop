<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Mail\MailController;

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
Route::get('/book/{slug}', [BooksController::class, 'getSingleBook']);

Route::get('/book/{slug}/report', [MailController::class, 'emailTemplate'])->name('book_report');
Route::post('/book/{slug}/report', [MailController::class, 'sendReportMessage']);

Auth::routes();
Route::group(['middleware' => 'auth'], function() {
    //Route::resource('/book', BooksController::class);
    Route::post('/book', [ReviewsController::class, 'storeBookReview']);

        Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function() {
        Route::get('/', [AdminController::class, 'index'])->name('admin_page');
        Route::get('/change-email', [AdminController::class, 'changeEmailView'])->name('admin_change_email');
        Route::put('/change-email{id}', [AdminController::class, 'updateEmail']);
        Route::get('/change-password', [AdminController::class, 'changePasswordView'])->name('admin_change_password');
        Route::put('/change-password/{id}', [AdminController::class, 'changePassword']);
        Route::get('/create-new-user', [AdminController::class, 'createNewUserView'])->name('create_new_user');
        Route::post('/create-new-user', [AdminController::class, 'createNewUser']);
        Route::delete('/{id}', [AdminController::class, 'deleteBook']);
        Route::put('/{id}', [AdminController::class, 'approveBook']);
    });
    
    Route::group(['middleware' => 'user', 'prefix' => 'user'], function() {
        Route::get('/', [UserController::class, 'index'])->name('user_page');
        Route::delete('/{id}', [UserController::class, 'deleteBook']);
        Route::get('/change-email', [UserController::class, 'changeEmailView'])->name('user_change_email');
        Route::put('/change-email/{id}', [UserController::class, 'changeEmail']);
        //Route::get('/book/report/{id}', [MailController::class, 'emailTemplate'])->name('book_report');
        //Route::post('/book-report/{id}', [MailController::class, 'sendReportMessage']);
    });
});

