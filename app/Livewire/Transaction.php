<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;
use App\Models\Post;

class Transaction extends Component
{
    use WithPagination;
    public $id;
    public function render()
    {   $transaction = Post::where('id', $this->id)->first();
        $orders = Order::where('post_id', $transaction->id)->orderByDesc('created_at')->paginate(10);
        return view('livewire.transaction', ['transaction' => $transaction, 'orders' => $orders]);
    }
}
