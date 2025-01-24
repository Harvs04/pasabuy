<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth; 
use Livewire\Component;
use App\Models\User;

class Navbar extends Component
{

    public User $user;

    public function __construct()
    {
        $this->user = User::where('id', Auth::user()->id)->firstOrFail();
    }

    public function signOut() 
    {
        Auth::logout();
        return $this->redirect(route('login'), true);
    }

    public function updateIsSeen()
    {
        foreach($this->user->notifications() as $notif) {
            $notif->isSeen = true;
            $notif->save();
        }
    }

    public function render()
    {
        return view('livewire.navbar');
    }
}
