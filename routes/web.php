<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});


Route::get('/login', function () {
    return view('login');
});


Route::get('/profile', function () {
    return view('profile');
});
Route::get('/agenda', function () {
    return view('agenda');
});

