<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Post;
use App\Models\User;

class Transaction extends Component
{
    use WithPagination;
    public $id;
    public $user;

    public function __construct()
    {
        $this->user = User::where('id',Auth::user()->id)->first();
    }

    public function updateStatus($type)
    {
        try {
            $transaction = Post::where('id', $this->id)->first();
            $transaction->status = $type;
            $transaction->save();

            if ($type === 'cancelled') {
                foreach($transaction->orders as $order) {
                    $order->item_status = 'Cancelled';
                    $order->save();

                    $this->user->pasabuy_points -= 5;
                    $this->user->save();
                    
                    Notification::create([
                        'type' => 'transaction cancelled',
                        'post_id' => $this->id,
                        'actor_id' => Auth::user()->id,
                        'poster_id' => User::where('id', $order->customer_id)->first()->id
                    ]);
                }
            }

            sleep(1.5);
            session()->flash('start_success', 'Transaction status updated!');
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
