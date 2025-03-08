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
        'messages' => ['How to start a conversation?', 'Can I message another user?', 'How long can I keep sending a message to a provider or customer?'],
        'saved' => ['How to save a post?', 'Can I order an item in saved post page?', 'How to go back in the dashboard?'],
        'orders' => ['How to view a specific order?', 'How to confirm an order as delivered?', 'How to rate a transaction?', 'How to cancel an order?'],
        'transactions' => ['How to view a specific transaction?', 'How to start a transaction?', 'How to update the status of orders?'],
        'history' => ['Where can I see customer\'s rating?', 'How to rate a transaction?', 'Can I still send message after an order is delivered?', 'How to go back in the dashboard?']
    ];
    
    public $routes;

    public $action_answers = [
        'dashboard' => ['To make a post, just click the oval shape containing the phrase \'Looking for items? Click here.\' or \'Making a transactions? Click here.\'0', 'To log out, click your profile picture at the top right corner of your device and click the \'log out\' button0', 'To add an order, click the \'Order item\' button at the bottom of an open transaction in your dashboard.0'],
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

    public $final = "You're welcome!0";

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
        } else if ($message === 'Thank you!') {
            array_push($this->conversation, $this->final);
        } else if ($message === 'Reset conversation1') {
            array_push($this->conversation, $this->routes);
            dd($this->conversation);
        } else {
            $this->action_index = array_search($message, $this->actions[$this->current_route]);
            // dd($this->action_index);
            array_push($this->conversation, $this->action_answers[$this->current_route][$this->action_index]);
            array_push($this->conversation, $this->enders);
        }
    }


    public function render()
    {
        return view('livewire.chatbot');
    }
}