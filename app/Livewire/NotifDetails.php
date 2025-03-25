<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NotifDetails extends Component
{

    public $user; 

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.notif-details');
    }
}
