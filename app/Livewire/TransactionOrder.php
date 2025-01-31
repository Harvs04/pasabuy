<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\User;

class TransactionOrder extends Component
{

    public $t_id;
    public $order;

    public function render()
    {
        $transaction = Post::where('id', $this->t_id)->first();
        $user = User::where('id', $this->order->customer_id)->first();
        return view('livewire.transaction-order', ['transaction' => $transaction, 'user' => $user]);
    }
}
