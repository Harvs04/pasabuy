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
        'dashboard' => ['How can I help you?', 'How to make a post?', 'How to log out?', 'How to add order?'],
        'messages' => ['How can I help you?', 'How to make a post?', 'How to log out?', 'How to add order?'],
        'saved' => ['How can I help you?', 'How to make a post?', 'How to log out?', 'How to add order?'],
        'orders' => ['How can I help you?', 'How to make a post?', 'How to log out?', 'How to add order?'],
        'transactions' => ['How can I help you?', 'How to make a post?', 'How to log out?', 'How to add order?'],
        'history' => ['How can I help you?', 'How to make a post?', 'How to log out?', 'How to add order?']
    ]; 

    public function __construct() 
    {
        $this->user = Auth::user();
    }

    public function add_message($message)
    {   
        if ($message === 'stay here1') {
            if ($this->current_route === 'dashboard') {
                array_push($this->conversation, $this->actions['dashboard']);
            } else if ($this->current_route === 'messages') {
                array_push($this->conversation, $this->actions['messages']);
            } else if ($this->current_route === 'saved') {
                array_push($this->conversation, $this->actions['saved']);
            } else if ($this->current_route === 'orders') {
                array_push($this->conversation, $this->actions['orders']);
            } else if ($this->current_route === 'transactions') {
                array_push($this->conversation, $this->actions['transactions']);
            } else if ($this->current_route === 'history') {
                array_push($this->conversation, $this->actions['history']);
            }
        }
        // dd($this->conversation);
    }

    public function render()
    {
        return view('livewire.chatbot');
    }
}
