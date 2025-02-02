<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class TransactionOrder extends Component
{

    public $t_id;
    public $order;
    public $user;

    public function __construct()
    {
        $this->user = User::where('id',Auth::user()->id)->first();
    }

    public function saveChanges($purchased, $delivered, $rated, $isPaid)
    {
        try {
            $status = '';
            if ($purchased && $delivered && $rated) {
                $status = 'Rated';
            } else if (!$purchased && !$delivered && !$rated) {
                $status = 'Pending';
            } else if ($purchased) {
                $status = 'Acquired';
            } else if ($delivered) {
                $status = 'Delivered';
            } else if ($rated) {
                $status = 'Rated';
            }

            if ($this->order->item_status !== $status) {
                $this->order->item_status = $status;
            }

            if ($this->order->is_paid !== $isPaid) {
                $this->order->is_paid = $isPaid ? 1 : 0;
                $this->order->save();
            }

            sleep(1.5);
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

            if ($type === 'cancelled') {
                foreach($transaction->orders as $order) {
                    $order->item_status = 'Cancelled';
                    $order->save();

                    $this->user->pasabuy_points -= 5;
                    $this->user->save();

                    Notification::create([
                        'type' => 'transaction cancelled',
                        'post_id' => $this->t_id,
                        'actor_id' => Auth::user()->id,
                        'poster_id' => User::where('id', $order->customer_id)->first()->id
                    ]);
                }
            }

            sleep(1.5);
            session()->flash('start_success', 'Transaction status updated!');
            return $this->redirect(route('transaction-order.view', ['transaction_id' => $this->t_id, 'order_id' => $this->order->id]), true);
        } catch (\Throwable $th) {
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('transaction-order.view', ['transaction_id' => $this->t_id, 'order_id' => $this->order->id]), true);
        }
    }

    public function deleteOrder()
    {
        try {
            $transaction = Post::where('id', $this->t_id)->first();
            $customer_id = $this->order->customer_id;
            $this->order->delete();
            
            $transaction->order_count--;
            $transaction->status = 'open';
            $transaction->save();
            sleep(1.5);

            Notification::create([
                'type' => 'item deleted',
                'post_id' => $this->t_id,
                'actor_id' => Auth::user()->id,
                'poster_id' => $customer_id
            ]);

            session()->flash('delete_success', 'Order deleted!');
            return $this->redirect(route('transaction.view', ['id' => $this->t_id]), true);
        } catch (\Throwable $th) {
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('transaction.view', ['id' => $this->t_id]), true);
        }
    }

    public function render()
    {
        $transaction = Post::where('id', $this->t_id)->first();
        $user = User::where('id', $this->order->customer_id)->first();
        return view('livewire.transaction-order', ['transaction' => $transaction, 'user' => $user]);
    }
}
