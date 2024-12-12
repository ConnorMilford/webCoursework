<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;


Route::get('/posts', [HomePageController::class, 'index'])->name('posts.index');

Route::get('/posts/{post}', [HomePageController::class, 'show'])->name('posts.show');

//shows login page
Route::get('/accounts/login', [UserAccountController::class, 'login'])->name('accounts.login');

Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::post('/posts/save', [PostController::class, 'savePost'])->name('posts.savePost');

Route::post('/posts/unsave', [PostController::class, 'unsavePost'])->name('posts.removeSavedPost');

Route::get('/accounts/{id}', [UserAccountController::class, 'show'])->name('accounts.show');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts/saved', [PostController::class, 'saved'])->name('posts.saved');


Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/{notificationId}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markRead');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::patch('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// lecture 10 slide 18
//advised laravel structure




