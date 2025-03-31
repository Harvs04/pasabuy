<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\User;
use App\Models\Notification;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use App\Models\Conversation;

class OrderView extends Component
{

    public $t_id;
    public $order;
    public $user;
    public $convo_id;

    public $star_rating = 0;
    public $remarks;

    public function __construct()
    {
        $this->user = User::where('id',Auth::user()->id)->first();
    }

    public function mount()
    {
        $this->convo_id = Conversation::where('provider_id', $this->order->provider_id)->where('customer_id', $this->order->customer_id)->first()->id;
    }

    public function confirmDelivery()
    {
        try {
            $this->order->item_status = 'Delivered';
            $this->order->save();

            // notif for confirming
            Notification::create([
                'type' => 'item confirmed',
                'post_id' => $this->order->post_id,
                'order_id' => [$this->order->id],
                'actor_id' => $this->order->customer_id,
                'poster_id' => $this->order->provider_id,
                'order_count' => 1
            ]);

            $customer = User::where('id', $this->order->customer_id)->first();
            $customer->successful_orders += 1;
            $customer->save();

            $provider = User::where('id', $this->order->provider_id)->first();
            $provider->successful_deliveries += 1;
            $provider->save();

            session()->flash('order_updated_success', 'Delivery Confirmed!');
            return $this->redirect(route('my-orders-order.view', ['transaction_id' => $this->t_id, 'order_id' => $this->order->id]), true);

        } catch (\Throwable $th) {
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('my-orders-order.view', ['transaction_id' => $this->t_id, 'order_id' => $this->order->id]), true);
        }
    }

    public function updateStatus($type)
    {
        try {
            $transaction = Post::where('id', $this->t_id)->first();
            $transaction->status = $type;
            $transaction->save();

            if ($type === 'cancelled') {

                if (count($transaction->orders) > 0) {
                    $this->user->pasabuy_points -= 5;
                    $this->user->save();
                    foreach($transaction->orders as $order) {
                        $order->item_status = 'Cancelled';
                        $order->save();
    
                        Notification::create([
                            'type' => 'transaction cancelled',
                            'post_id' => $this->t_id,
                            'order_id' => [$order->id],
                            'actor_id' => Auth::user()->id,
                            'poster_id' => User::where('id', $order->customer_id)->first()->id,
                            'order_count' => 1
                        ]);
                    }
                }
            }

            session()->flash('start_success', 'Transaction status updated!');
            return $this->redirect(route('transaction-order.view', ['transaction_id' => $this->t_id, 'order_id' => $this->order->id]), true);
        } catch (\Throwable $th) {
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('transaction-order.view', ['transaction_id' => $this->t_id, 'order_id' => $this->order->id]), true);
        }
    }

    public function cancelOrder()
    {
        try {
            $this->order->item_status = 'Cancelled';
            $this->order->save();
            $this->user->cancelled_orders += 1;

            $transaction = Post::where('id', $this->t_id)->first();
            if ($transaction->status === 'ongoing') {
                $this->user->pasabuy_points -= 5;
            }
            
            $this->user->save();

            Notification::create([
                'type' => 'cancelled order',
                'post_id' => $this->t_id,
                'order_id' => [$this->order->id],
                'actor_id' => $this->order->customer_id,
                'poster_id' => $this->order->provider_id,
                'order_count' => 1
            ]);

            session()->flash('cancel_success', 'Order cancelled!');
            return $this->redirect(route('my-orders-order.view', ['transaction_id' => $this->t_id, 'order_id' => $this->order->id]), true);
        } catch (\Throwable $th) {
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('my-orders-order.view', ['transaction_id' => $this->t_id, 'order_id' => $this->order->id]), true);
        }
    }

    public function rateTransaction()
    {
        try {
            $this->order->item_status = 'Rated';
            $this->order->save();

            $rating = [
                'post_id' => $this->t_id,
                'order_id' => $this->order->id,
                'provider_id' => $this->order->provider_id,
                'customer_id' => $this->order->customer_id,
                'star_rating' => $this->star_rating, 
                'remarks' => $this->remarks
            ];

            Rating::create($rating);
            Notification::create([
                'type' => 'item rated',
                'post_id' => $this->t_id,
                'order_id' => [$this->order->id],
                'actor_id' => $this->order->customer_id,
                'poster_id' => $this->order->provider_id,
                'order_count' => 1
            ]);

            session()->flash('item_rated_success', 'Transaction rated!');
            return $this->redirect(route('my-orders-order.view', ['transaction_id' => $this->t_id, 'order_id' => $this->order->id]), true);
        } catch (\Throwable $th) {
            dd($th);
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('my-orders-order.view', ['transaction_id' => $this->t_id, 'order_id' => $this->order->id]), true);
        }
    }

    public function render()
    {
        $transaction = Post::where('id', $this->t_id)->first();
        $user = User::where('id', $this->order->customer_id)->first();
        return view('livewire.order-view', ['transaction' => $transaction, 'user' => $user]);
    }
}
