<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleBasedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {

            if (Auth::user()->role === 'admin') {
                return response()->view('admin.admin-dashboard');
            }
            
            return response()->view('dashboard');
        }

        return redirect()->route('login')->with('error', 'Unauthorized access.');
    }
}
