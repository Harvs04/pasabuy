<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Chatbot extends Component
{

    public $current_route;
    public $user;

    public function __construct() 
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.chatbot');
    }
}
