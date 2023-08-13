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


Route::prefix('/users')
    ->middleware('admin')
    ->controller(UserController::class)
    ->group(function () {
        Route::get('/', 'index')->name('users.index');
        Route::get('/create', 'create')->name('users.create');
        Route::get('/{user}/edit', 'edit')->name('users.edit');
        Route::get('/{user}', 'show')->name('users.show');
        Route::post('/', 'store')->name('users.store');
        Route::put('/{user}', 'update')->name('users.update');
        Route::delete('/{user}', 'destroy')->name('users.destroy');
        Route::get('/{user}/posts', 'getPostsByUser')->name('users.posts');
    });

// Route::prefix('users')->controller(PostController::class)->group(function(){
//     Route::get('/{user}/posts', 'index')->name('posts.index');
//     Route::get('/create','create')->name('posts.create');
//     Route::post('/','store')->name('posts.store');
//     Route::get('/{post}','show')->name('posts.show');
//     Route::get('/{post}/edit','edit')->name('posts.edit');
//     Route::match(['PUT','PATH'],'/{post}','update')->name('posts.update');
//     Route::delete('/{post}','destroy')->name('posts.destroy');
// });

Route::resource('posts', PostController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('language/{lang}', [LanguageController::class, 'changeLanguage'])->name('locale');

require __DIR__.'/auth.php';
