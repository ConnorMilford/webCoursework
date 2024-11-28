<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAccountController;


Route::get('/accounts', [UserAccountController::class, 'index'])->name('accounts.index');

//Diplays page to create new animal 
Route::get('/accounts/create', [UserAccountController::class,'create'])->name('accounts.create');

//Actually stores the created animal 
Route::post('/accounts', [UserAccountController::class, 'store'])->name('accounts.store');

// shows a user profile
Route::get('/accounts/{id}', [UserAccountController::class, 'show'])->name('accounts.show');

// lecture 10 slide 18
//advised laravel structure




