<?php

use App\Http\Controllers\CloudinaryController;
use App\Http\Controllers\SidebarController;
use App\Http\Controllers\SocialiteController;
use App\Http\Middleware\RoleBasedMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Login;
use App\Livewire\Navbar;
use App\Livewire\Register;
use App\Livewire\Sidebar;

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

Route::get('/messages', [SidebarController::class, 'messages'])->name('messages');

Route::get('/saved', [SidebarController::class, 'saved'])->name('saved');

Route::get('/my-orders', [SidebarController::class, 'orders'])->name('my-orders');

Route::get('/transactions', [SidebarController::class, 'transactions'])->name('transactions');

Route::get('/my-history', [SidebarController::class, 'history'])->name('pasabuy-history');

Route::get('profile/{name}', function($name) {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    if (Auth::user()->name !== $name) {
        return view('forbidden');
    }

    return view('profile', ['name' => $name]);
})->name('profile');

Route::get('/upload', function() {
    return view('upload');
})->name('upload');


Route::resource('cloudinary', CloudinaryController::class);