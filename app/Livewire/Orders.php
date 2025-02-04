<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;

    public $user; 
    
    public function render()
    {
        $this->user = Auth::user();
        // Extract post IDs from the user's orders
        $postIds = collect($this->user->orders)->pluck('post_id')->toArray();

        // Retrieve the posts matching these IDs
        $transactions = Post::whereIn('id', $postIds)->paginate('10');

        return view('livewire.orders', ['user' => $this->user, 'transactions' => $transactions]);
    }
}
