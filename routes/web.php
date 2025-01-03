<?php

use App\Http\Controllers\CloudinaryController;
use App\Http\Controllers\SocialiteController;
use App\Http\Middleware\RoleBasedMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Login;
use App\Livewire\Register;

// google auth
Route::controller(SocialiteController::class)->group(function(){
    Route::get('auth/google', 'googleLogin')->name('auth.google');
    Route::get('auth/google-callback', 'googleAuthentication')->name('auth.google-callback');
});

Route::get('/', function () {
    return view('welcome');
})->name('landing');

Route::get('/login', function(){
    return view('login');
})->name('login');

Route::get('/register', function() {
    return view('register');
})->name('signup');

Route::middleware(['auth', RoleBasedMiddleware::class])->group(function () {
    Route::get('/dashboard', function () {
    })->name('dashboard');
});

Route::get('{name}/profile', function($name) {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    if (Auth::user()->name !== $name) {
        abort(403, 'Unauthorized access');
    }

    return view('profile', ['name' => $name]);
})->name('profile');

Route::get('/upload', function() {
    return view('upload');
})->name('upload');


Route::resource('cloudinary', CloudinaryController::class);