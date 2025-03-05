<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [PostController::class, 'index'])->name('home');

    Route::get('/posts/my-posts', [PostController::class, 'userPosts'])->name('posts.user-posts');
    Route::get('/post/{id}/pdf', [PostController::class, 'downloadPDF'])->name('post.pdf');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/upload-image', [PostController::class, 'uploadImage'])->name('upload.image');
    Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');

    Route::resource('posts', PostController::class)
        ->names('posts')
        ->parameters(['posts' => 'post']);

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

    Route::get('/mod/pending', [PostController::class, 'showPendingPosts'])->name('moderation.pending-posts');
    Route::get('/mod/pending/{post}', [PostController::class, 'showPendingPost'])->name('moderation.pending-show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';
