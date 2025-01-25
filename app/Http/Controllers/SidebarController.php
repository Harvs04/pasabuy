<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SidebarController extends Controller
{
    public function messages()
    {
        if (Auth::check()) {
            return response()->view('messages');
        }
    
        return redirect()->route('login')->with('error', 'Unauthorized access.');
    }

    public function saved()
    {
        if (Auth::check()) {
            return response()->view('saved');
        }
    
        return redirect()->route('login')->with('error', 'Unauthorized access.');
    }

    public function orders()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        if (Auth::user()->role === 'provider') {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }
        
        return response()->view('orders');
    }

    public function transactions()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        if (Auth::user()->role === 'customer') {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }
        
        return response()->view('transactions');
    }

    public function history()
    {
        if (Auth::check()) {
            return response()->view('history');
        }
    
        return redirect()->route('login')->with('error', 'Unauthorized access.');
    }
}
