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


    // sorting table
    public $f_status = '';
    public $f_provider = ''; 
    public $f_itemname = ''; 
    public $f_itemorigin = ''; 
    public $f_ordercount = ''; 
    public $f_meetupplace = '';
    
    public function render()
    {
        $this->user = Auth::user();
        // Extract post IDs from the user's orders
        $postIds = collect($this->user->orders)->pluck('post_id')->toArray();

        // Retrieve the posts matching these IDs
        $transactions = Post::whereIn('id', $postIds);

        // Apply filters if they are set
        if ($this->f_status) {
            $transactions = $transactions->orderBy('status', $this->f_status);

        } elseif (!empty($this->f_provider)) {
            $transactions = Post::join('users', 'posts.user_id', '=', 'users.id')
            ->whereIn('posts.id', $postIds) // qualify the 'id' column here
            ->orderBy('users.name', $this->f_provider)
            ->select('posts.*');

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
        return view('livewire.orders', ['user' => $this->user, 'transactions' => $transactions]);
    }
}
