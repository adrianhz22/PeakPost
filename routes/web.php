<?php

use App\Http\Controllers\Gallery\GalleryImageController;
use App\Http\Controllers\Moderation\ActivityLogController;
use App\Http\Controllers\Moderation\AdminDashboardController;
use App\Http\Controllers\Moderation\ImageModerationController;
use App\Http\Controllers\Moderation\PostModerationController;
use App\Http\Controllers\Moderation\UserModerationController;
use App\Http\Controllers\PDF\PDFController;
use App\Http\Controllers\Post\CommentController;
use App\Http\Controllers\Post\LikeController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\User\FollowController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/terms', [PDFController::class, 'downloadTermsPDF'])->name('terms.pdf');

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
    Route::get('/my-likes', [LikeController::class, 'userLikedPosts'])->name('posts.liked');
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
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [UserModerationController::class, 'users'])->name('admin.users');
    Route::get('/admin/approved-posts', [PostModerationController::class, 'approvedPosts'])->name('admin.approvedPosts');
    Route::delete('/admin/destroy/{user}', [UserController::class, 'destroy'])->name('admin.destroy');
    Route::get('/admin/activity-log', [ActivityLogController::class, 'index'])->name('admin.activity-log');
    Route::post('/admin/logs/delete-last', [ActivityLogController::class, 'deleteLastLogs'])->name('admin.logs.deleteLast');
    Route::post('/admin/users/{user}/assign-role', [UserModerationController::class, 'assignRole'])->name('admin.users.assignRole');
    Route::post('/admin/users/{user}/remove-role', [UserModerationController::class, 'removeRole'])->name('admin.users.removeRole');
});

Route::middleware(['auth', 'moderator'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/mod/pending', [PostModerationController::class, 'showPendingPosts'])->name('moderation.pending-posts');
    Route::get('/mod/pending/{post}', [PostModerationController::class, 'showPendingPost'])->name('moderation.show');
    Route::put('/mod/pending/{post}/approve', [PostModerationController::class, 'approve'])->name('moderation.approve');
    Route::patch('/mod/pending/{post}/reject', [PostModerationController::class, 'reject'])->name('moderation.reject');

    Route::get('/pending-images', [ImageModerationController::class, 'pendingImages'])->name('moderation.pending-images');
    Route::put('/images/{image}/approve', [ImageModerationController::class, 'approveImage'])->name('moderation.images.approve');
    Route::patch('/images/{image}/reject', [ImageModerationController::class, 'rejectImage'])->name('moderation.images.reject');
});
