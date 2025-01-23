<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth; 
use Livewire\Component;
use App\Models\User;

class Sidebar extends Component
{

    public User $user;

    public function __construct()
    {
        $this->user = User::where('id', Auth::user()->id)->firstOrFail();
    }
    public function render()
    {
        return view('livewire.sidebar');
    }
}
