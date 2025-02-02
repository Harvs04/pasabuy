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

    public function cancelTransaction($id)
    {
        try {
            $transaction = Post::where('id', $id)->first();
            if (!$transaction) {
                session()->flash('error', 'An error occurred. Please try again.');
                return $this->redirect(route('transactions'), true);
            }

            $transaction->status = 'cancelled';
            $transaction->save();

            $this->user->pasabuy_points -= 5;
            $this->user->save();

            foreach($transaction->orders as $order) {
                $order->item_status = 'Cancelled';
                $order->save();
                
                Notification::create([
                    'type' => 'transaction cancelled',
                    'post_id' => $id,
                    'actor_id' => $this->user->id,
                    'poster_id' => User::where('id', $order->customer_id)->first()->id
                ]);
            }

            sleep(1.5);
            session()->flash('cancel_success', 'Transaction deleted!');
            return $this->redirect(route('transactions'), true);

        } catch (\Throwable $th) {
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('transactions'), true);
        }
        

    
    }

    public function render()
    {
        $this->user = Auth::user();
        $transactions = Post::where('user_id', $this->user->id)->where('type', 'transaction')->orderByDesc('created_at')->paginate(10);
        return view('livewire.transactions', ['user' => $this->user, 'transactions' => $transactions]);
    }
}
