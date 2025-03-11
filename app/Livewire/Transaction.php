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

    public function acquireOrder($t_id, $ids) 
    {
        try {

            $transaction = Post::where('id', $t_id)->first();
            if (!$transaction) {
                session()->flash('error', 'An error occurred. Please try again.');
                return $this->redirect(route('transaction.view', ['id' => $this->id]), true);
            }

            $orders = Order::whereIn('id', $ids)->get()->groupBy('customer_id');

            if ($orders->isEmpty()) {
                session()->flash('error', 'An error occurred. Please try again.');
                return $this->redirect(route('transaction.view', ['id' => $this->id]), true);
            }

            // Update item status for all orders
            foreach ($orders as $customer_id => $customerOrders) {
                foreach ($customerOrders as $order) {
                    $order->item_status = 'Acquired';
                    $order->save();
                }

                // Create a single notification per customer
                Notification::create([
                    'type' => 'item bought',
                    'post_id' => $customerOrders->first()->post_id,
                    'actor_id' => $this->user->id,
                    'poster_id' => $customer_id,
                    'order_count' => $customerOrders->count()
                ]);
            }

            session()->flash('action_success', 'Order acquired!');
            return $this->redirect(route('transaction.view', ['id' => $this->id]), true);

        } catch (\Throwable $th) {
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('transaction.view', ['id' => $this->id]), true);
        }
    }

    public function deliverOrder($t_id, $ids) 
    {
        try {

            $transaction = Post::where('id', $t_id)->first();
            if (!$transaction) {
                session()->flash('error', 'An error occurred. Please try again.');
                return $this->redirect(route('transaction.view', ['id' => $this->id]), true);
            }
            
            $orders = Order::whereIn('id', $ids)->get()->groupBy('customer_id');

            if ($orders->isEmpty()) {
                session()->flash('error', 'An error occurred. Please try again.');
                return $this->redirect(route('transaction.view', ['id' => $this->id]), true);
            }

            // Update item status for all orders
            foreach ($orders as $customer_id => $customerOrders) {
                foreach ($customerOrders as $order) {
                    $order->item_status = 'Waiting';
                    $order->date_delivered = now();
                    $order->save();
                }

                // Create a single notification per customer
                Notification::create([
                    'type' => 'item waiting',
                    'post_id' => $customerOrders->first()->post_id,
                    'actor_id' => $this->user->id,
                    'poster_id' => $customer_id,
                    'order_count' => $customerOrders->count()
                ]);
            }

            session()->flash('action_success', 'Order marked as delivered!');
            return $this->redirect(route('transaction.view', ['id' => $this->id]), true);

        } catch (\Throwable $th) {
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('transaction.view', ['id' => $this->id]), true);
        }
    }


    public function unavailableOrder($t_id, $ids) 
    {
        try {

            $transaction = Post::where('id', $t_id)->first();
            if (!$transaction) {
                session()->flash('error', 'An error occurred. Please try again.');
                return $this->redirect(route('transaction.view', ['id' => $this->id]), true);
            }
            
            $orders = Order::whereIn('id', $ids)->get()->groupBy('customer_id');

            if ($orders->isEmpty()) {
                session()->flash('error', 'An error occurred. Please try again.');
                return $this->redirect(route('transaction.view', ['id' => $this->id]), true);
            }

            // Update item status for all orders
            foreach ($orders as $customer_id => $customerOrders) {
                foreach ($customerOrders as $order) {
                    $order->item_status = 'Unavailable';
                    $order->save();
                }

                // Create a single notification per customer
                Notification::create([
                    'type' => 'item unavailable',
                    'post_id' => $customerOrders->first()->post_id,
                    'actor_id' => $this->user->id,
                    'poster_id' => $customer_id,
                    'order_count' => $customerOrders->count()
                ]);
            }

            session()->flash('action_success', 'Order marked as unavailable!');
            return $this->redirect(route('transaction.view', ['id' => $this->id]), true);

        } catch (\Throwable $th) {
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('transaction.view', ['id' => $this->id]), true);
        }
    }

    public function updateStatus($type)
    {
        try {
            $transaction = Post::where('id', $this->id)->first();
            $transaction->status = $type;
            $transaction->save();

            if ($type === 'cancelled') {

                if (count($transaction->orders) > 0) {
                    $this->user->pasabuy_points -= 5;
                    $this->user->cancelled_transactions += 1;
                    $this->user->save();
    
                    foreach($transaction->orders as $order) {
                        $order->item_status = 'Cancelled';
                        $order->save();
                        
                        Notification::create([
                            'type' => 'transaction cancelled',
                            'post_id' => $this->id,
                            'actor_id' => Auth::user()->id,
                            'poster_id' => User::where('id', $order->customer_id)->first()->id
                        ]);
                    }
                }
            }

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
