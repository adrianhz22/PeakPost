<?php

use App\Http\Controllers\AdminDashboardController;
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
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/upload-image', [PostController::class, 'uploadImage'])->name('upload.image');

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
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminDashboardController::class, 'users'])->name('admin.users');
    Route::get('/admin/posts', [AdminDashboardController::class, 'posts'])->name('admin.posts');
    Route::delete('/admin/destroy/{user}', [UserController::class, 'destroy'])->name('admin.destroy');
});

Route::middleware(['auth', 'moderator'])->group(function () {
    Route::get('/mod/pending', [PostController::class, 'showPendingPosts'])->name('moderation.pending-posts');
    Route::get('/mod/pending/{post}', [PostController::class, 'showPendingPost'])->name('moderation.pending-show');
    Route::put('/mod/pending/{post}/approve', [PostController::class, 'approve'])->name('moderation.approve');
    Route::delete('/mod/pending/{post}/reject', [PostController::class, 'reject'])->name('moderation.reject');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';
