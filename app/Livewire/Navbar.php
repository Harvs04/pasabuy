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

    public function switchRole()
    {
        $user = $this->user;
        $user->role === 'customer' ? $user->role = 'provider' : $user->role = 'customer'; 
        $user->save();

        sleep(1.5);
        session()->flash('change_role_success', "You are now logged in as " . ucwords($user->role) . ".");
        return redirect(request()->header('Referer'));
    }

    public function signOut() 
    {
        Auth::logout();
        return $this->redirect(route('login'), true);
    }

    public function updateIsSeen()
    {
        foreach($this->user->notification_as_poster as $notif) {
            $notif->isSeen = true;
            $notif->save();
        }
    }

    public function render()
    {
        return view('livewire.navbar');
    }
}
