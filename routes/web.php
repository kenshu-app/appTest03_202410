<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::resource('books', App\Http\Controllers\BookController::class);
    Route::get('/likes', [App\Http\Controllers\LikeController::class, 'index'])->name('likes.index');
    Route::post('/likes', [App\Http\Controllers\LikeController::class, 'store'])->name('likes.store');
    Route::delete('/likes', [App\Http\Controllers\LikeController::class, 'destroy'])->name('likes.destroy');
});
