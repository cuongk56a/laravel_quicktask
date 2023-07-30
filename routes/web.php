<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('users',UserController::class)->middleware(['admin']);

Route::prefix('post')->controller(PostController::class)->group(function(){
    Route::get('/','index')->name('posts.index');
    Route::get('/create','create')->name('posts.create');
    Route::post('/','store')->name('posts.store');
    Route::get('/{post}','show')->name('posts.show');
    Route::get('/{post}/edit','edit')->name('posts.edit');
    Route::match(['PUT','PATH'],'/{post}','update')->name('posts.update');
    Route::delete('/{post}','destroy')->name('posts.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/lang/{lang}', [LanguageController::class, 'changeLanguage'])->name('lang');

require __DIR__.'/auth.php';
