<?php

use App\Http\Controllers\CloudinaryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SidebarController;
use App\Http\Controllers\SocialiteController;
use App\Http\Middleware\RoleBasedMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Conversation;
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

    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
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

Route::get('/messages/{convo_id}', function($convo_id){
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $convo = Conversation::where('id', $convo_id)->first();
    if (!$convo) {
        return view('missing');
    }

    $found = false;

    if (Auth::user()->role === 'provider') {
        foreach (Auth::user()->conversations_as_provider as $convo) {
            if ($convo->id == $convo_id) {
                $found = true;
                break; 
            }
        }
    } else if (Auth::user()->role === 'customer') {
        foreach (Auth::user()->conversations_as_customer as $convo) {
            if ($convo->id == $convo_id) {
                $found = true;
                break; 
            }
        }
    }

    if (!$found) {
        return view('missing');
    }

    return view('message-view', ['convo_id' => $convo_id]);
})->name('message.view');

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
        if ($order->post_id == $id) {
            $found = true;
            break; 
        }
    }

    if (!$found) {
        return view('missing');
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
        if ($order_info->id === $order_id) {
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
        if ($order_info->id === $order_id) {
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

Route::get('my-history/{order_id}', function($order_id) {

    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $order = Order::where('id', $order_id)->first();
    
    if (!$order) {
        return view('missing');
    }

    if (!in_array($order->item_status, ['Delivered', 'Rated', 'Unavailable', 'Cancelled'])) {
        return view('missing');
    }

    $list = Auth::user()->role === 'customer' ? Auth::user()->orders : Auth::user()->deliveries;
    $found = false; 

    foreach ($list as $list_item) {
        if ($order->id === $list_item->id) {
            $found = true; 
            break;
        }
    }

    if (!$found) {
        return view('missing');
    }

    return view('history-order', ['order' => $order]);
})->name('history.view');

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


// ADMIN
Route::get('/admin/user-list', function() {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    if (Auth::user()->role !== 'admin') {
        return view('missing');
    }

    return view('admin.user-list');
})->name('user-list');

Route::get('/admin/post-list', function() {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    if (Auth::user()->role !== 'admin') {
        return view('missing');
    }

    return view('admin.post-list');
})->name('post-list');

Route::get('/admin/order-list', function() {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    if (Auth::user()->role !== 'admin') {
        return view('missing');
    }

    return view('admin.order-list');
})->name('order-list');

Route::get('/admin/report-list', function() {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    if (Auth::user()->role !== 'admin') {
        return view('missing');
    }

    return view('admin.report-list');
})->name('report-list');

Route::resource('cloudinary', CloudinaryController::class);

Route::fallback([PageController::class, 'notfound']);