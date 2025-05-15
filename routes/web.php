<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\GalleryImageController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [PostController::class, 'index'])->name('home');
    Route::get('/users/{user:username}', [UserController::class, 'show'])->name('users.show');
    Route::get('/usuarios', [UserController::class, 'index'])->name('users.index');

    Route::get('/posts/my-posts', [PostController::class, 'userPosts'])->name('posts.user-posts');
    Route::get('/post/{id}/pdf', [PDFController::class, 'downloadPDF'])->name('post.pdf');
    Route::get('/terms', [PDFController::class, 'downloadTermsPDF'])->name('terms.pdf');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/upload-image', [PostController::class, 'uploadImage'])->name('upload.image');
    Route::get('/my-likes', [PostController::class, 'userLikedPosts'])->name('posts.liked');
    Route::get('/gallery', [GalleryImageController::class, 'index'])->name('gallery.index');
    Route::post('/gallery', [GalleryImageController::class, 'store'])->name('gallery.store');

    Route::resource('posts', PostController::class)
        ->names('posts')
        ->parameters(['posts' => 'post']);

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo');

    Route::post('/follow/{user}', [FollowController::class, 'follow'])->name('follow');
    Route::delete('/unfollow/{user}', [FollowController::class, 'unfollow'])->name('unfollow');
    Route::get('/users/{user:username}/followers', [UserController::class, 'followers'])->name('users.followers');
    Route::get('/users/{user:username}/following', [UserController::class, 'following'])->name('users.following');

});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [AdminDashboardController::class, 'users'])->name('admin.users');
    Route::get('/admin/approved-posts', [AdminDashboardController::class, 'approvedPosts'])->name('admin.approvedPosts');
    Route::delete('/admin/destroy/{user}', [UserController::class, 'destroy'])->name('admin.destroy');
    Route::get('/admin/historial', [ActivityLogController::class, 'index'])->name('admin.historial');
});

Route::middleware(['auth', 'moderator'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/mod/pending', [AdminDashboardController::class, 'showPendingPosts'])->name('moderation.pending-posts');
    Route::get('/mod/pending/{post}', [AdminDashboardController::class, 'showPendingPost'])->name('moderation.pending-show');
    Route::put('/mod/pending/{post}/approve', [AdminDashboardController::class, 'approve'])->name('moderation.approve');
    Route::patch('/mod/pending/{post}/reject', [AdminDashboardController::class, 'reject'])->name('moderation.reject');
    Route::get('/pending-images', [AdminDashboardController::class, 'pendingImages'])->name('moderation.pending-images');
    Route::put('/images/{image}/approve', [AdminDashboardController::class, 'approveImage'])->name('moderation.images.approve');
    Route::patch('/images/{image}/reject', [AdminDashboardController::class, 'rejectImage'])->name('moderation.images.reject');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';
