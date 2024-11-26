<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// https://canvas.swansea.ac.uk/courses/52735/files/7256039?module_item_id=3001447
Route::get('/home/{name}', function ($name) {
    return "Welcome to $name's home page";
});
