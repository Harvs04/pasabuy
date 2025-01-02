<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SocialiteController extends Controller
{
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleAuthentication()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Check if the domain is 'up.edu.ph'
            if ($googleUser->user['hd'] === 'up.edu.ph') {

                $user = User::where('google_id', $googleUser->id)->first();
                
                if ($user) {
                    // User exists, log them in
                    Auth::login($user);
                    return redirect()->route('dashboard');
                } else {
                    // User does not exist, create a new user
                    $userData = User::create([
                        'name' => $googleUser->name, 
                        'email' => $googleUser->email,
                        'role' => 'customer',
                        'google_id' => $googleUser->id
                    ]);
        
                    if ($userData) {
                        // Successfully created the user, log them in
                        Auth::login($userData);
                        return redirect()->route('dashboard');
                    }
                }
            } else {
                // If the domain is not 'up.edu.ph', show an error and redirect to login
                return redirect()->route('login')->withErrors(['email' => 'You must login with a UP Mail address.']);
            }
        } catch (Exception $e) {
            // Handle any exception that occurs during the authentication process
            return redirect()->route('login')->withErrors(['error' => 'Only UP-registered emails are allowed!']);
        }        
    }
}
