<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Post;

class Transaction extends Component
{
    use WithPagination;
    public $id;
    public $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function startTransaction()
    {
        try {
            $transaction = Post::where('id', $this->id)->first();
            $transaction->status = 'ongoing';
            $transaction->save();

            sleep(1.5);
            session()->flash('start_success', 'Transaction started!');
            return $this->redirect(route('transaction.view', ['id' => $this->id]), true);
        } catch (\Throwable $th) {
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('transaction.view', ['id' => $this->id]), true);
        }
    }

    public function deleteOrder($id)
    {
        try {
            $transaction = Post::where('id', $this->id)->first();
            $order = Order::where('id', $id)->first();
            $customer_id = $order->customer_id;
            $order->delete();
            
            $transaction->order_count--;
            $transaction->save();
            sleep(1.5);

            Notification::create([
                'type' => 'item deleted',
                'post_id' => $this->id,
                'actor_id' => $this->user->id,
                'poster_id' => $customer_id
            ]);

            session()->flash('delete_success', 'Order deleted!');
            return $this->redirect(route('transaction.view', ['id' => $this->id]), true);
        } catch (\Throwable $th) {
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('transaction.view', ['id' => $this->id]), true);
        }
    }

    public function render()
    {  
        $transaction = Post::where('id', $this->id)->first();
        $orders = Order::where('post_id', $transaction->id)->orderByDesc('created_at')->paginate(10);
        return view('livewire.transaction', ['transaction' => $transaction, 'orders' => $orders]);
    }
}
