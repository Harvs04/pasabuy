<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Post;
use App\Models\Notification;
use App\Models\User;
use Livewire\WithPagination;

class Transactions extends Component
{

    use WithPagination;
    public $user;

    public function updateTransaction($ids, $type) 
    {
        try {
            foreach ($ids as $id) {
                $transaction = Post::where('id', $id)->first();
                if (!$transaction) {
                    session()->flash('error', 'An error occurred. Please try again.');
                    return $this->redirect(route('transactions'), true);
                }

                $transaction->status = $type;
                $transaction->save();

                if (count($transaction->orders) > 0 && $type === 'cancelled') {

                    if ($transaction->status === 'ongoing') {
                        $this->user->pasabuy_points -= 5;
                    }
        
                    $ordersGroupedByCustomer = $transaction->orders->groupBy('customer_id');

                    foreach ($ordersGroupedByCustomer as $customerId => $orders) {
                        foreach ($orders as $order) {
                            if ($order->item_status === 'Pending') {
                                $order->item_status = 'Cancelled';
                                $order->save();
                            }
                        }

                        // Send only one notification per customer
                        Notification::create([
                            'type' => 'transaction cancelled',
                            'post_id' => $id,
                            'order_id' => $orders,
                            'actor_id' => $this->user->id,
                            'poster_id' => $customerId,
                            'order_count' => count($orders)
                        ]);
                    }

                }
            }

            $this->user->cancelled_transactions += count($ids);
            $this->user->save();

            session()->flash('action_success', $type === 'ongoing' ? 'Transaction started' : 'Transaction cancelled!');
            return $this->redirect(route('transactions'), true);

        } catch (\Throwable $th) {
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('transactions'), true);
        }
    }

    public function render()
    {
        $this->user = Auth::user();
        $transactions = Post::where('user_id', $this->user->id)->where('type', 'transaction')->orderByDesc('created_at')->get();
        return view('livewire.transactions', ['user' => $this->user, 'transactions' => $transactions]);
    }
}
