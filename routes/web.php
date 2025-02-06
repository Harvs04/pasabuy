<?php

use App\Http\Controllers\CloudinaryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SidebarController;
use App\Http\Controllers\SocialiteController;
use App\Http\Middleware\RoleBasedMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Order;

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

Route::get('my-orders/{id}', function($id) {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    if (Auth::user()->role !== 'customer') {
        return view('forbidden');
    }

    $post = Post::where('id', $id)->first();

    if (!$post) {
        return view('missing');
    }

    $found = false;

    // dd(Auth::user()->orders);

    foreach (Auth::user()->orders as $order) {
        if ($order->post_id == (int)$id) {
            $found = true;
            break; // Exit loop once the matching order is found
        }
    }

    if (!$found) {
        return view('forbidden');
    }

    return view('order-list', ['id' => $id]);
})->name('my-orders.view');

Route::get('my-orders/{transaction_id}/order/{order_id}', function($transaction_id, $order_id) {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    if (Auth::user()->role !== 'customer') {
        return view('forbidden');
    }

    $post = Post::where('id', $transaction_id)->first();

    if (!$post) {
        return view('missing');
    }

    $found = false;
    foreach($post->orders as $order_info) {
        if ($order_info->id === (int)$order_id) {
            $found = true;
            break;
        }
    }

    if (!$found) {
        return view('missing');
    }

    $order = Order::where('id', $order_id)->first();
    if (!$order) {
        return view('missing');
    }

    return view('order-view', ['transaction_id' => $transaction_id, 'order' => $order]);
})->name('my-orders-order.view');

Route::get('/transactions', [SidebarController::class, 'transactions'])->name('transactions');

Route::get('transactions/{id}', function($id) {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    if (Auth::user()->role !== 'provider') {
        return view('forbidden');
    }

    $post = Post::where('id', $id)->first();

    if (!$post) {
        return view('missing');
    }

    if (Auth::user()->id !== $post->user_id) {
        return view('forbidden');
    }

    return view('transaction', ['id' => $id]);
})->name('transaction.view');

Route::get('transactions/{transaction_id}/order/{order_id}', function($transaction_id, $order_id) {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    if (Auth::user()->role !== 'provider') {
        return view('forbidden');
    }

    $post = Post::where('id', $transaction_id)->first();

    if (!$post) {
        return view('missing');
    }

    if (Auth::user()->id !== $post->user_id) {
        return view('forbidden');
    }

    $found = false;
    foreach($post->orders as $order_info) {
        if ($order_info->id === (int)$order_id) {
            $found = true;
            break;
        }
    }

    if (!$found) {
        return view('missing');
    }

    $order = Order::where('id', $order_id)->first();
    if (!$order) {
        return view('missing');
    }

    return view('transaction-order', ['transaction_id' => $transaction_id, 'order' => $order]);
})->name('transaction-order.view');

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

Route::fallback([PageController::class, 'notfound']);