<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/editpost', function () {
    return view('editpost');
});

Route::get('/users', function () {
    return view('users');
});
