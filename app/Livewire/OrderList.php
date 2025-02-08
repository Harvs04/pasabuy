<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Order;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class OrderList extends Component
{

    public $id;
    public $user;

    public function __construct()
    {
        $this->user = User::where('id', Auth::user()->id)->first();
    }


    public function cancelOrder($t_id, $id)
    {
        try {
            $order = Order::where('id', $id)->first();
            if (!$order) {
                session()->flash('error', 'An error occurred. Please try again.');
                return $this->redirect(route('my-orders.view', ['id' =>  $t_id]), true);
            }

            $order->item_status = 'Cancelled';
            $order->save();

            $this->user->pasabuy_points -= 5;
            $this->user->cancelled_orders += 1;
            $this->user->save();
            
                    
            Notification::create([
                'type' => 'cancelled order',
                'post_id' => $order->post_id,
                'actor_id' => $this->user->id,
                'poster_id' => $order->provider_id
            ]);
                

            sleep(1.5);
            session()->flash('cancel_success', 'Transaction cancelled!');
            return $this->redirect(route('my-orders.view', ['id' => $t_id]), true);

        } catch (\Throwable $th) {
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('my-orders.view', ['id' =>  $t_id]), true);
        }
    }

    public function render()
    {
        $transaction = Post::where('id', $this->id)->first();
        $orders = Order::where('post_id', $transaction->id)->where('customer_id', $this->user->id)->orderByDesc('created_at')->paginate(10);
        return view('livewire.order-list', ['transaction' => $transaction, 'orders' => $orders]);
    }
}
