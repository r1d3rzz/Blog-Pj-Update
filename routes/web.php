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
    Route::get('/admin/blogs', 'index')->middleware('admin');
    Route::post('/admin/{blog:slug}/isPublish', 'blogPublishHandler')->middleware('admin');
    Route::get('/admin/blogs/create', 'create')->middleware('admin');
    Route::get('/admin/categories/create/category', 'create_category')->middleware('admin');
    Route::post('/admin/categories/create/category', 'store_category')->middleware('admin');
    Route::delete('/admin/{category:slug}/delete/category', 'destroy_category')->middleware('admin');
    Route::post('/admin/blog/store', 'store')->middleware('admin');
    Route::delete('/admin/{blog:slug}/delete', 'destroy')->middleware('admin');
    Route::get('/admin/users', 'users_index')->middleware('admin');
    Route::delete('/admin/user/{user:username}/delete', 'destroy_user')->middleware('admin');
    Route::get('/admin/{blog:slug}/update', 'update')->middleware('admin');
    Route::post('/admin/{blog:slug}/update', 'post_update')->middleware('admin');
});
