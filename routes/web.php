<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [PostController::class, 'index'])->name('home');
    Route::get('/post/{post}', [PostController::class, 'show'])->name('show');
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/store', [PostController::class, 'store'])->name('store');
    Route::get('/edit/{post}', [PostController::class, 'edit'])->name('edit');
    Route::put('/update/{post}', [PostController::class, 'update'])->name('update');
    Route::delete('/destroy/{post}', [PostController::class, 'destroy'])->name('destroy');
    Route::post('/upload-image', [PostController::class, 'uploadImage'])->name('upload.image');
    Route::get('/my-posts', [PostController::class, 'userPosts'])->name('user.posts');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [UserController::class, 'index'])->name('admin.dashboard');
    Route::delete('/admin/destroy/{user}', [UserController::class, 'destroy'])->name('admin.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
