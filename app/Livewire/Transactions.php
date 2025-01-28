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
    public function render()
    {
        $this->user = Auth::user();
        $transactions = Post::where('user_id', $this->user->id)->orderByDesc('created_at')->paginate(10);
        return view('livewire.transactions', ['user' => $this->user, 'transactions' => $transactions]);
    }
}
