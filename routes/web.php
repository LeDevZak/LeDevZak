<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

Route::post('newsletter', NewsletterController::class);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

// Admin Section
Route::middleware(['auth'])->group(function () {
    Route::resource('admin/posts', AdminPostController::class)->except('show');
});

// Route::middleware('can:admin')->group(function () {
//     Route::get('admin/posts', 'AdminPostController@index')->name('posts.index');
//     Route::post('admin/posts', 'AdminPostController@store')->name('posts.store');
//     Route::get('admin/posts/create', 'AdminPostController@create')->name('posts.create');
//     Route::put('admin/posts/{post}', 'AdminPostController@update')->name('posts.update');
//     Route::delete('admin/posts/{post}', 'AdminPostController@destroy')->name('posts.destroy');
//     Route::get('admin/posts/{post}/edit', 'AdminPostController@edit')->name('posts.edit');
// });

