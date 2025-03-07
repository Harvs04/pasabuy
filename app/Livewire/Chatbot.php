<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Chatbot extends Component
{

    public $current_route;
    public $action_index;
    public $user;
    public $conversation = [];
    public $starter;
    public $actions = [
        'dashboard' => ['How to make a post?', 'How to log out?', 'How to add order?'],
        'messages' => ['How to make a post?', 'How to log out?', 'How to add order?'],
        'saved' => ['How to make a post?', 'How to log out?', 'How to add order?'],
        'orders' => ['How to make a post?', 'How to log out?', 'How to add order?'],
        'transactions' => ['How to make a post?', 'How to log out?', 'How to add order?'],
        'history' => ['How to make a post?', 'How to log out?', 'How to add order?']
    ];
    
    public $routes;

    public $action_answers = [
        'dashboard' => ['To make a post, just click the oval shape containing the phrase \'Looking for items? Click here.\' or \'Making a transactions? Click here.\'0', 'How to log out?0', 'How to add order?0'],
        'messages' => ['How to make a post?0', 'How to log out?0', 'How to add order?0'],
        'saved' => ['How to make a post?0', 'How to log out?0', 'How to add order?0'],
        'orders' => ['How to make a post?0', 'How to log out?0', 'How to add order?0'],
        'transactions' => ['How to make a post?0', 'How to log out?0', 'How to add order?0'],
        'history' => ['How to make a post?0', 'How to log out?0', 'How to add order?0']
    ]; 

    public $answer = [];

    public $enders = [
        'Thank you!', 'Reset conversation'
    ];

    public function __construct() 
    {
        $this->user = Auth::user();
        $this->starter = 'How can I help you today, ' . $this->user->name . '?0';
        $this->routes = $this->user->role === 'customer' 
        ? [
            'dashboard' => route('dashboard'),
            'messages' => route('messages'),
            'saved' => route('saved'),
            'orders' => route('my-orders'),
            'history' => route('pasabuy-history'),
            'profile' => route('profile', ['name' => $this->user->name])
        ] 
        : [
            'dashboard' => route('dashboard'),
            'messages' => route('messages'),
            'saved' => route('saved'),
            'transactions' => route('transactions'),
            'history' => route('pasabuy-history'),
            'profile' => route('profile', ['name' => $this->user->name])
        ];
    }

    public function add_message($message)
    {   
        if ($message === 'stay here1') {
            array_push($this->conversation, $this->starter);
            array_push($this->conversation, $this->actions[$this->current_route]);
        } else if ($message === 'Thank you!1') {
            dd($this->conversation);
        }
        else if ($message !== 'Reset conversation1') {
            $this->action_index = array_search($message, $this->actions[$this->current_route]);
            array_push($this->conversation, $this->action_answers[$this->current_route][$this->action_index]);
            array_push($this->conversation, $this->enders);
            // dd($this->conversation);
        }
    }

    public function render()
    {
        return view('livewire.chatbot');
    }
}