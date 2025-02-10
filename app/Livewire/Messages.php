<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Messages extends Component
{

    public $user; 

    public function __construct()
    {
        $this->user = Auth::user();
    }


    public function messageView($convo_id)
    {
        return $this->redirect(route('message.view', ['convo_id' => $convo_id]), true);
    }


    public function render()
    {
        return view('livewire.messages');
    }
}
