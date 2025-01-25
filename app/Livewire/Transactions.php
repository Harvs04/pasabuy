<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Transactions extends Component
{
    public $user;
    public function render()
    {
        $this->user = Auth::user();
        return view('livewire.transactions', ['user' => $this->user]);
    }
}
