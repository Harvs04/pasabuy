<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    public $email = '';
    public $password = '';

    public function login()
    {
        $credentials = [
            'email' => $this->email, 
            'password' => $this->password
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'admin') {  
                return redirect()->route('login');
            } 
            
            return redirect()->route('dashboard');
            
        }

        session()->flash('login_failed', 'Incorrect login credentials. Try again.');
        $this->reset(['email', 'password']);
    }
    public function render()
    {
        return view('livewire.login');
    }
}
