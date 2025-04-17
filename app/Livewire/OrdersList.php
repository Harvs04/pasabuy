<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrdersList extends Component
{
    public $user;
    public $orders;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->orders = Order::all();
    }

    public function render()
    {
        return view('livewire.orders-list');
    }
}
