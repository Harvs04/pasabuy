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

                $sameEmailUser = User::where('email', $googleUser->email)->first();

                if ($sameEmailUser && $sameEmailUser->google_id === null) {
                    return redirect()->route('login')->with('duplicate', 'This email address is already in use!');
                }

                $user = User::where('google_id', $googleUser->id)->first();
                
                if ($user) {
                    // User exists, log them in
                    Auth::login($user);
                    return redirect()->route('dashboard');
                } else {
                    // User does not exist, create a new user
                    $userData = User::create([
                        'name' => $googleUser->name, 
                        'constituent' => null, 
                        'email' => $googleUser->email,
                        'role' => 'customer',
                        'google_id' => $googleUser->id,
                        'profile_pic_url' => $googleUser->avatar,
                        'email_verified_at' => now()
                    ]);
        
                    if ($userData) {
                        // Successfully created the user, log them in
                        Auth::login($userData);
                        return redirect()->route('dashboard');
                    }
                }
            } else {
                // If the domain is not 'up.edu.ph', show an error and redirect to login
                return redirect()->route('login')->with('non-up', 'Only UP-registered emails are allowed!');
            }
        } catch (Exception $e) {
            // Handle any exception that occurs during the authentication process
            return redirect()->route('login')->with('non-up', 'Only UP-registered emails are allowed!');
        }        
    }
}
