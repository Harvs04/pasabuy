<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class MessageView extends Component
{

    public $user;
    public $receiver_id;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function messageView($receiver_id)
    {
        return $this->redirect(route('message.view', ['receiver_id' => $receiver_id]), true);
    }

    public function render()
    {
        return view('livewire.message-view');
    }
}
