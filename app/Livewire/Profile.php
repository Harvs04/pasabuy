<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{
    public function render()
    {
        $user = Auth::user();
        return view('livewire.profile', ['user' => $user]);
    }
}
