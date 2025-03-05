<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Chatbot extends Component
{

    public $current_route;
    public $user;
    public $conversation = [];
    public $actions = [
        'dashboard' => ['How to make a post?0', 'How to log out?0', 'How to add order?0'],
    ]; 

    public function __construct() 
    {
        $this->user = Auth::user();
    }

    public function add_message($message)
    {   
        if ($message === 'stay here1') {
            if ($this->current_route === 'dashboard') {
                // foreach ($this->actions['dashboard'] as $action) {
                //     array_push($this->conversation, $action);
                // }
                array_push($this->conversation, $this->actions['dashboard']);
            }
        }
    }

    public function render()
    {
        return view('livewire.chatbot');
    }
}
