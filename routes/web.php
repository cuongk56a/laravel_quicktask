<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users',UserController::class);

Route::prefix('post')->controller(PostController::class)->group(function(){
    Route::get('/','index')->name('posts.index');
    Route::get('/create','create')->name('posts.create');
    Route::post('/','store')->name('posts.store');
    Route::get('/{post}','show')->name('posts.show');
    Route::get('/{post}/edit','edit')->name('posts.edit');
    Route::match(['PUT','PATH'],'/{post}','update')->name('posts.update');
    Route::delete('/{post}','destroy')->name('posts.destroy');
});
