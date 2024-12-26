<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth; 
use Livewire\Component;
use App\Models\User;

class ProviderDashboard extends Component
{
    public function switchRole()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user->role = 'customer';
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
        $user = Auth::user(); 
        return view('livewire.provider-dashboard', ['user' => $user]);
    }
}
