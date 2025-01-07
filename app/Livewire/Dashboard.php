<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth; 
use Livewire\Component;
use App\Models\User;

class Dashboard extends Component
{
    public User $user;
    public $post_type = "";
    public $item_type = [];
    public $mode_of_payment = [];
    public $delivery_date = "";


    public function __construct()
    {
        $this->user = User::where('id', Auth::user()->id)->firstOrFail();
    }

    public function switchRole()
    {
        $user = $this->user;
        $user->role === 'customer' ? $user->role = 'provider' : $user->role = 'customer'; 
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
        return view('livewire.dashboard', ['user' => $user]);
    }
}
