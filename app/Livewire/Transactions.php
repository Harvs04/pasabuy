<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Post;
use App\Models\Notification;
use Livewire\WithPagination;

class Transactions extends Component
{

    use WithPagination;
    public $user;
    
    public $f_tstatus = '';
    // sorting table
    public $f_itemname = ''; 
    public $f_itemorigin = ''; 
    public $f_ordercount = ''; 
    public $f_meetupplace = '';

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
                            'order_id' => $orders->pluck('id')->toArray(),
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
        $transactions = Post::where('user_id', $this->user->id)->where('type', 'transaction');

        // Apply filters if they are set
        if ($this->f_tstatus) {
            $transactions = $transactions->orderBy('status', $this->f_tstatus);

        } elseif (!empty($this->f_itemname)) {
            $transactions = $transactions->orderBy('item_name', $this->f_itemname);
            

        } elseif (!empty($this->f_itemorigin)) {
            $transactions = $transactions->orderBy('item_origin', $this->f_itemorigin);

        } elseif (!empty($this->f_ordercount)) {
            $transactions = $transactions->withCount('orders')
            ->orderBy('orders_count', $this->f_ordercount);

        } elseif (!empty($this->f_meetupplace)) {
            $transactions = $transactions->orderBy('meetup_place', $this->f_meetupplace);

        }

        $transactions = $transactions->get();
        return view('livewire.transactions', ['user' => $this->user, 'transactions' => $transactions]);
    }
}
