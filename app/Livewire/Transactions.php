<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class Transactions extends Component
{

    use WithPagination;
    public $user;

    public function deleteTransaction($id)
    {
        try {
            $transaction = Post::where('id', $id)->first();

            if (!$transaction) {
                session()->flash('error', 'An error occurred. Please try again.');
                return $this->redirect(route('transactions'), true);
            }

            $transaction->delete();

            sleep(1.5);
            session()->flash('delete_success', 'Transaction deleted!');
            return $this->redirect(route('transactions'), true);

        } catch (\Throwable $th) {
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('transactions'), true);
        }
        

    
    }

    public function render()
    {
        $this->user = Auth::user();
        $transactions = Post::where('user_id', $this->user->id)->orderByDesc('created_at')->paginate(10);
        return view('livewire.transactions', ['user' => $this->user, 'transactions' => $transactions]);
    }
}
