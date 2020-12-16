<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostLikeController;

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
Route::get('/dashboard' , [App\Http\Controllers\DashboardController::class ,'index'])->name('dashboard');
Route::get('/post' , [App\Http\Controllers\PostController::class , 'index'])->name('post')
->middleware('auth');
Route::post('/post' , [App\Http\Controllers\PostController::class , 'store'])->middleware('auth');
Route::post('/posts/{post}/likes' ,[PostLikeController::class , 'store'])->name('posts.likes');
Route::delete('/posts/{post}/likes' , [App\Http\Controllers\PostLikeController::class , 'destroy'])->name('posts.likes');
Route::delete('/post/{post}/delete' , [App\Http\Controllers\PostController::class , 'destroy'])->name('post.delete');
Route::get('/user/{post}/post' , [App\Http\Controllers\UserPostController::class , 'index'])->name('users.posts');