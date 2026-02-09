<?php

use App\Http\Controllers\Admin\ArticleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Articles
Route::get('articles/trashed', [ArticleController::class, 'trashed'])->name('articles.trashed');
Route::post('articles/{article}/restore', [ArticleController::class, 'restore'])->name('articles.restore')->withTrashed();

Route::resource('articles', ArticleController::class);
Route::delete('articles/{article}/forceDelete}', [ArticleController::class, 'forceDelete'])->name('articles.forceDelete')->withTrashed();


require __DIR__.'/settings.php';
