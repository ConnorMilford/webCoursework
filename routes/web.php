<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAccountController;


Route::get('/accounts', [UserAccountController::class, 'index'])->name('accounts.index');

//Diplays page to create new animal 
Route::get('/accounts/create', [UserAccountController::class,'create'])->name('accounts.create');

// posts login
Route::post('/accounts/postLogin', [UserAccountController::class, 'postLogin'])->name('accounts.postLogin');

//Actually stores the created animal 
Route::post('/accounts', [UserAccountController::class, 'store'])->name('accounts.store');

// shows a user profile
Route::get('/accounts/{id}', [UserAccountController::class, 'show'])->name('accounts.show');

//shows login page
Route::get('/accounts/login', [UserAccountController::class, 'login'])->name('accounts.login');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// lecture 10 slide 18
//advised laravel structure




