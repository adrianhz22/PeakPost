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

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {

    Route::get('/home', [PostController::class, 'index'])->name('home');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user:username}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user:username}/followers', [UserController::class, 'followers'])->name('users.followers');
    Route::get('/users/{user:username}/following', [UserController::class, 'following'])->name('users.following');

    Route::post('/follow/{user}', [FollowController::class, 'follow'])->name('follow');
    Route::delete('/unfollow/{user}', [FollowController::class, 'unfollow'])->name('unfollow');

    Route::get('/posts/my-posts', [PostController::class, 'userPosts'])->name('posts.user-posts');
    Route::get('/my-likes', [PostController::class, 'userLikedPosts'])->name('posts.liked');
    Route::get('/post/{id}/pdf', [PDFController::class, 'downloadPDF'])->name('post.pdf');
    Route::post('/trix-image', [PostController::class, 'uploadTrixImage'])->name('trix.image');
    Route::resource('posts', PostController::class)->names('posts')->parameters(['posts' => 'post']);

    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::get('/gallery', [GalleryImageController::class, 'index'])->name('gallery.index');
    Route::get('/gallery/my-images', [GalleryImageController::class, 'userImages'])->name('gallery.user-images');
    Route::post('/gallery', [GalleryImageController::class, 'store'])->name('gallery.store');
    Route::delete('/gallery/{image}', [GalleryImageController::class, 'destroy'])->name('gallery.destroy');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo');

    Route::get('/terms', [PDFController::class, 'downloadTermsPDF'])->name('terms.pdf');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [AdminDashboardController::class, 'users'])->name('admin.users');
    Route::get('/admin/approved-posts', [AdminDashboardController::class, 'approvedPosts'])->name('admin.approvedPosts');
    Route::delete('/admin/destroy/{user}', [UserController::class, 'destroy'])->name('admin.destroy');
    Route::get('/admin/activity-log', [ActivityLogController::class, 'index'])->name('admin.activity-log');
    Route::post('/admin/logs/delete-last', [ActivityLogController::class, 'deleteLastLogs'])->name('admin.logs.deleteLast');
    Route::post('/admin/users/{user}/assign-role', [AdminDashboardController::class, 'assignRole'])->name('admin.users.assignRole');
    Route::post('/admin/users/{user}/remove-role', [AdminDashboardController::class, 'removeRole'])->name('admin.users.removeRole');
});

Route::middleware(['auth', 'moderator'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/mod/pending', [AdminDashboardController::class, 'showPendingPosts'])->name('moderation.pending-posts');
    Route::get('/mod/pending/{post}', [PostController::class, 'show'])->name('moderation.show');
    Route::put('/mod/pending/{post}/approve', [AdminDashboardController::class, 'approve'])->name('moderation.approve');
    Route::patch('/mod/pending/{post}/reject', [AdminDashboardController::class, 'reject'])->name('moderation.reject');

    Route::get('/pending-images', [AdminDashboardController::class, 'pendingImages'])->name('moderation.pending-images');
    Route::put('/images/{image}/approve', [AdminDashboardController::class, 'approveImage'])->name('moderation.images.approve');
    Route::patch('/images/{image}/reject', [AdminDashboardController::class, 'rejectImage'])->name('moderation.images.reject');
});
