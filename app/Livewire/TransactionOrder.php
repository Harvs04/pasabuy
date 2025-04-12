<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\Conversation;
use App\Models\Report;

class TransactionOrder extends Component
{

    public $t_id;
    public $order;
    public $orders;
    public $user;
    public $convo_id;


    public $complaint = '';
    public $exists;

    public function __construct()
    {
        $this->user = User::where('id',Auth::user()->id)->first();
    }

    public function mount()
    {
        $this->convo_id = Conversation::where('provider_id', $this->order->provider_id)->where('customer_id', $this->order->customer_id)->first()->id;
    }

    public function saveChanges($purchased, $delivered, $isPaid)
    {
        try {
            $status = '';
            if ($purchased && $delivered) {
                $status = 'Rated';
            } else if (!$purchased && !$delivered) {
                $status = 'Pending';
            } else if ($purchased) {
                $status = 'Acquired';

                Notification::create([
                    'type' => 'item bought',
                    'post_id' => $this->order->post_id,
                    'order_id' => [$this->order->id],
                    'actor_id' => $this->order->provider_id,
                    'poster_id' => $this->order->customer_id,
                    'order_count' => 1
                ]);

            } else if ($delivered) {
                $status = 'Waiting';
                $this->order->date_delivered = now();

                Notification::create([
                    'type' => 'item waiting',
                    'post_id' => $this->order->post_id,
                    'order_id' => [$this->order->id],
                    'actor_id' => $this->order->provider_id,
                    'poster_id' => $this->order->customer_id,
                    'order_count' => 1
                ]);
            }

            if ($this->order->item_status !== $status) {
                $this->order->item_status = $status;
            }

            if ($this->order->is_paid !== $isPaid) {
                $this->order->is_paid = $isPaid ? 1 : 0;
            }
            
            $this->order->save();
            
            session()->flash('order_updated_success', 'Order status updated!');
            return $this->redirect(route('transaction-order.view', ['transaction_id' => $this->t_id, 'order_id' => $this->order->id]), true);

        } catch (\Throwable $th) {
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('transaction-order.view', ['transaction_id' => $this->t_id, 'order_id' => $this->order->id]), true);
        }
    }

    public function updateStatus($type)
    {
        try {
            $transaction = Post::where('id', $this->t_id)->first();
            $transaction->status = $type;
            $transaction->save();

            $ordersGroupedByCustomer = $transaction->orders->where('item_status', 'Pending')->groupBy('customer_id');

            foreach ($ordersGroupedByCustomer as $customerId => $orders) {
                foreach ($orders as $order) {
                    if ($type === 'cancelled' && $order->item_status === 'Pending') {
                        $order->item_status = 'Cancelled';                        
                    } else if ($type === 'ongoing') {
                        $order->item_status = 'Pending';                        
                    }
                    $order->save();
                }

                if ($type === 'cancelled') {
                    // Send only one notification per customer
                    Notification::create([
                        'type' => 'transaction cancelled',
                        'post_id' => $this->t_id,
                        'order_id' => $orders->pluck('id')->toArray(),
                        'actor_id' => Auth::user()->id,
                        'poster_id' => $customerId,
                        'order_count' => count($orders)
                    ]);
                } else if ($type === 'ongoing') {
                    // Send only one notification per customer
                    Notification::create([
                        'type' => 'transaction started',
                        'post_id' => $this->t_id,
                        'order_id' => $orders->pluck('id')->toArray(),
                        'actor_id' => Auth::user()->id,
                        'poster_id' => $customerId,
                        'order_count' => count($orders)
                    ]);
                }
            }

            if ($type === 'cancelled') {
                $this->user->cancelled_transactions += 1;
                $this->user->pasabuy_points -= 5;
                $this->user->save();
            }

            session()->flash('start_success', 'Transaction status updated!');
            return $this->redirect(route('transaction-order.view', ['transaction_id' => $this->t_id, 'order_id' => $this->order->id]), true);
        } catch (\Throwable $th) {
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('transaction-order.view', ['transaction_id' => $this->t_id, 'order_id' => $this->order->id]), true);
        }
    }

    public function unavailableOrder()
    {
        try {
            $transaction = Post::where('id', $this->t_id)->first();
            if (!$transaction) {
                session()->flash('error', 'An error occurred. Please try again.');
                return $this->redirect(route('transaction-order.view', ['transaction_id' => $this->t_id, 'order_id' => $this->order->id]), true);
            } 

            $this->order->item_status = 'Unavailable';
            $this->order->save();
            
            Notification::create([
                'type' => 'item unavailable',
                'post_id' => $this->t_id,
                'order_id' => [$this->order->id],
                'actor_id' => Auth::user()->id,
                'poster_id' => $this->order->customer_id,
                'order_count' => 1
            ]);

            session()->flash('delete_success', 'Order status set to unavailable!');
            return $this->redirect(route('transaction-order.view', ['transaction_id' => $this->t_id, 'order_id' => $this->order->id]), true);
        } catch (\Throwable $th) {
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('transaction-order.view', ['transaction_id' => $this->t_id, 'order_id' => $this->order->id]), true);
        }
    }

    public function reportUser($complaint_type) {
        try {

            $report = [
                'sender_id' => $this->user->id,
                'reported_id' => $this->order->customer_id,
                'post_id' => $this->t_id,
                'order_id' => $this->order->id,
                'type' => $complaint_type,
                'complaint' => $this->complaint
            ];
            Report::create($report);

            session()->flash('report_user_success', 'Report added!');
            return $this->redirect(route('transaction-order.view', ['transaction_id' => $this->t_id, 'order_id' => $this->order->id]), true);
        } catch (\Throwable $th) {
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('transaction-order.view', ['transaction_id' => $this->t_id, 'order_id' => $this->order->id]), true);
        }
    }

    public function render()
    {
        $transaction = Post::where('id', $this->t_id)->first();
        $this->orders = $transaction->orders;
        $user = User::where('id', $this->order->provider_id)->first();
        $this->exists = Report::where('sender_id', $this->user->id)->where('reported_id', $this->order->customer_id)->where('post_id', $this->t_id)->exists();
        return view('livewire.transaction-order', ['transaction' => $transaction, 'user' => $user]);
    }
}
