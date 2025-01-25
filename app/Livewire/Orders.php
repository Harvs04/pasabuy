<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Orders extends Component
{

    public $user; 
    
    public function render()
    {
        $this->user = Auth::user();
        return view('livewire.orders', ['user' => $this->user]);
    }
}
