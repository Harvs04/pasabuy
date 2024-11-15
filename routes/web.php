<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('livewire.login');
})->name('login');

Route::get('/register', function () {
    return view('livewire.signup');
})->name('signup');
