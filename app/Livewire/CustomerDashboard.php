<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth; 
use Livewire\Component;
use App\Models\User;

class CustomerDashboard extends Component
{
    public function switchRole()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user->role = 'provider';
        $user->save();
        return redirect(to: 'dashboard');
    }
    public function signOut() 
    {
        Auth::logout();
        return redirect('login');
    }
    public function render()
    {
        $user = Auth::user(); // Get the logged-in user
        return view('livewire.customer-dashboard', ['user' => $user]);
    }
}
