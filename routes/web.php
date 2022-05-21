<?php

use App\Http\Controllers\AdminBlogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
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

Route::controller(BlogController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/blogs/{blog:slug}', 'show');
    Route::post('/blogs/{blog:slug}/subscribe', 'subscribeHandler');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'create')->middleware('guest');
    Route::post('/register', 'store')->middleware('guest');
    Route::get('/logout', 'logout')->middleware('auth');
    Route::get('/login', 'login')->middleware('guest');
    Route::post('/login', 'post_login')->middleware('guest');
});

Route::controller(CommentController::class)->group(function () {
    Route::post('/blogs/{blog:slug}/comments', 'store');
});

Route::controller(AdminBlogController::class)->group(function () {
    Route::middleware('can:admin')->group(function () {
        Route::get('/admin/blogs', 'index');
        Route::post('/admin/{blog:slug}/isPublish', 'blogPublishHandler');
        Route::get('/admin/blogs/create', 'create');
        Route::get('/admin/categories/create/category', 'create_category');
        Route::post('/admin/categories/create/category', 'store_category');
        Route::delete('/admin/{category:slug}/delete/category', 'destroy_category');
        Route::post('/admin/blog/store', 'store');
        Route::delete('/admin/{blog:slug}/delete', 'destroy');
        Route::get('/admin/users', 'users_index');
        Route::delete('/admin/user/{user:username}/delete', 'destroy_user');
        Route::get('/admin/{blog:slug}/update', 'update');
        Route::patch('/admin/{blog:slug}/update', 'post_update');
    });
});
