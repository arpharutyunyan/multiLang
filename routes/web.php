<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('welcome');

Route::get('auth/google', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'redirectToGoogle'])->name('google');
Route::get('google/callback', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'handleGoogleCallback']);

Route::get('auth/facebook', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'redirectToFacebook'])->name('facebook');
Route::get('/callback', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'handleFacebookCallback']);

Route::group(['middleware' => ['auth']], function (){

    Route::resource('category', \App\Http\Controllers\CategoryController::class);
    Route::resource('product', \App\Http\Controllers\ProductController::class);
    Route::post('/image_upload', [\App\Http\Controllers\ProductController::class, 'imageUpload'])->name('upload');
    Route::post('/image_delete', [\App\Http\Controllers\ProductController::class, 'imageDelete'])->name('image_delete');
    Route::get('/getImages/{path}', [\App\Http\Controllers\ProductController::class, 'getImages'])->name('get_image');

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/user', function () {
        return view('admin.user');
    })->name('user');

    Route::put('/user', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'update'])->name('user.update');


});

require __DIR__.'/auth.php';
