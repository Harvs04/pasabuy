<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;

class Transaction extends Component
{
    use WithPagination;
    public $id;
    public function render()
    {
        $orders = Order::where('post_id', $this->id)->orderByDesc('created_at')->paginate(10);
        return view('livewire.transaction', ['orders' => $orders]);
    }
}
