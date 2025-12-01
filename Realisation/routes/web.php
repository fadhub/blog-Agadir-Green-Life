<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Routes d'administration des articles
Route::prefix('admin/articles')->name('admin.articles.')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/create', [ArticleController::class, 'create'])->name('create');
    Route::post('/', [ArticleController::class, 'store'])->name('store');
    Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('edit');
    Route::put('/{article}', [ArticleController::class, 'update'])->name('update');
    Route::delete('/{article}', [ArticleController::class, 'destroy'])->name('destroy');
    Route::get('/{article}', [ArticleController::class, 'show'])->name('show');
});
