<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Order;
use App\Models\User;
use App\Models\Notification;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class OrderList extends Component
{

    public $id;
    public $user;
    public $star_rating = 0;
    public $remarks = '';

    public function __construct()
    {
        $this->user = User::where('id', Auth::user()->id)->first();
    }

    public function confirmDelivery($t_id, $ids)
    {
        try {

            $transaction = Post::where('id', $t_id)->first();
            if (!$transaction) {
                session()->flash('error', 'An error occurred. Please try again.');
                return $this->redirect(route('my-orders.view', ['id' =>  $t_id]), true);
            }

            foreach ($ids as $id) {
                $order = Order::where('id', $id)->first();
                if (!$order) {
                    session()->flash('error', 'An error occurred. Please try again.');
                    return $this->redirect(route('my-orders.view', ['id' =>  $t_id]), true);
                }

                $order->item_status = 'Delivered';
                $order->save();
            }

            // notif for confirming
            Notification::create([
                'type' => 'item confirmed',
                'post_id' => $order->post_id,
                'order_id' => $ids,
                'actor_id' => $this->user->id,
                'poster_id' => $order->provider_id,
                'order_count' => count($ids)
            ]);

            // customer
            $this->user->successful_orders += count($ids);
            $this->user->save();

            // provider
            $provider = User::where('id', $order->provider_id)->first();
            $provider->successful_deliveries += count($ids);
            $provider->save();

            session()->flash('order_updated_success', 'Delivery Confirmed!');
            return $this->redirect(route('my-orders.view', ['id' =>  $t_id]), true);

        } catch (\Throwable $th) {
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('my-orders.view', ['id' =>  $t_id]), true);
        }
    }

    public function rateTransaction($t_id, $id)
    {
        try {
            $transaction = Post::where('id', $t_id)->first();
            if (!$transaction) {
                session()->flash('error', 'An error occurred. Please try again.');
                return $this->redirect(route('my-orders.view', ['id' =>  $t_id]), true);
            }

            $order = Order::where('id', $id)->first();
            if (!$order) {
                session()->flash('error', 'An error occurred. Please try again.');
                return $this->redirect(route('my-orders.view', ['id' =>  $t_id]), true);
            }

            $order->item_status = 'Rated';
            $order->save();

            $rating = [
                'post_id' => $t_id,
                'order_id' => $id,
                'provider_id' => $order->provider_id,
                'customer_id' => $this->user->id,
                'star_rating' => $this->star_rating, 
                'remarks' => $this->remarks
            ];

            Rating::create($rating);
            Notification::create([
                'type' => 'item rated',
                'post_id' => $t_id,
                'order_id' => [$id],
                'actor_id' => $this->user->id,
                'poster_id' => $order->provider_id,
                'order_count' => 1
            ]);

            session()->flash('item_rated_success', 'Transaction rated!');
            return $this->redirect(route('my-orders.view', ['id' =>  $t_id]), true);
        } catch (\Throwable $th) {
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('my-orders.view', ['id' =>  $t_id]), true);
        }
    }

    public function cancelOrder($t_id, $ids)
    {
        try {
            $transaction = Post::where('id', $t_id)->first();
            if (!$transaction) {
                session()->flash('error', 'An error occurred. Please try again.');
                return $this->redirect(route('my-orders.view', ['id' =>  $t_id]), true);
            }

            foreach ($ids as $id) {
                $order = Order::where('id', $id)->first();
                if (!$order) {
                    session()->flash('error', 'An error occurred. Please try again.');
                    return $this->redirect(route('my-orders.view', ['id' =>  $t_id]), true);
                }

                if ($order->item_status === 'Pending') {
                    $order->item_status = 'Cancelled';
                    $order->save();
                }

                $this->user->cancelled_orders += count($ids);
            }
            
            if ($transaction->status === 'ongoing') {
                $this->user->pasabuy_points -= 5;
            }
            
            $this->user->save();
                    
            Notification::create([
                'type' => 'cancelled order',
                'post_id' => $order->post_id,
                'order_id' => [$order->id],
                'actor_id' => $this->user->id,
                'poster_id' => $order->provider_id,
                'order_count' => count($ids)
            ]);
                
            session()->flash('cancel_success', 'order cancelled!');
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
