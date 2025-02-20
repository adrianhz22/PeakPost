<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/post/{post}', [PostController::class, 'show'])->name('show');
Route::get('/create', [PostController::class, 'create'])->name('create');
Route::post('/store', [PostController::class, 'store'])->name('store');
Route::get('/edit/{post}', [PostController::class, 'edit'])->name('edit');
Route::put('/update/{post}', [PostController::class, 'update'])->name('update');
Route::delete('/destroy/{post}', [PostController::class, 'destroy'])->name('destroy');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
