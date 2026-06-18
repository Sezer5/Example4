<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\KeywordController;
use App\Http\Controllers\Admin\PoemController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/login', [AdminController::class, "login"])->name('admin.login');
Route::post('/admin/auth', [AdminController::class, "auth"])->name('admin.auth');

Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('home', [AdminController::class, "index"])->name('home');
    Route::get('logout', [AdminController::class, "index"])->name('logout');

    Route::resource('keyword', KeywordController::class);
    Route::resource('article', ArticleController::class);
    Route::resource('poem', PoemController::class);
});
