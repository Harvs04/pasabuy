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
        'messages' => ['Creating conversations can be done through ordering items in a transaction as a customer or having new orders as a provider.0', 'Yes, you can message other users as long as they have a current order or transaction with you.0', 'You can message another user as long as the order of the user is not yet rated.0'],
        'saved' => ['To save a post, click the \'Save\' button at the bottom right of a post.0', 'Yes, you can order to a saved transaction as long as it is still open for orders.0', 'To go back to dashboard, you can use the sidebar and click \'Dashboard\' or you can also click the PASABUY logo in the navigation bar on top?0'],
        'orders' => ['To view a specific order, kindly choose the transaction with the order in mind, then you will see a list of orders and by clicking the \'View\' button or the eye icon, you will be redirected to your order.0', 'You can confirm a delivery of an order either via the \'Confirm\' button found in the list of orders or in the page of that specific order.0', 'You can rate the transaction and the provider either via the \'Rate\' button found in the list of orders or in the page of that specific order. Take note that you can only rate the transaction after you have confirmed that your order is delivered.0', 'You can cancel an order either via the \'Cancel\' button found in the list of orders or in the page of that specific order. Take note that you can only cancel an order as long as it is not yet acquired or bought by the provider.0'],
        'transactions' => ['To view a specific transaction, click the \'View\' button or the eye icon in the list of transactions.0', 'To start a transaction, you can either use the \'Start\' button in the list of transactions, start option found when you click the triple dots on top of a transaction\'s details, or using the start option in the page of a specific order.0', 'You can update the status of an either via the \'Acquire\', \'Deliver\', and \'Cancel\'  buttons found in the list of orders or in the page of each order.0'],
        'history' => ['To view the customer\'s rating, view a specific order history and navigate to the bottom of the page.0', 'To rate a transaction, click a specific order history using the \'View\' button or the eye icon. Then click the \'Rate\' button on the top of order details.0', 'To go back to dashboard, you can use the sidebar and click \'Dashboard\' or you can also click the PASABUY logo in the navigation bar on top?0'],
        'profile' => []
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
            // may error pa sa stay here na second time
        } else if ($message === 'Thank you!') {
            array_push($this->conversation, $this->final);
        } else if ($message === 'Reset conversation') {
            array_push($this->conversation, $this->routes);
            // dd($this->conversation);
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