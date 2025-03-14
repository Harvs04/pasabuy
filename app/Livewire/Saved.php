<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class Saved extends Component
{
    
    public $user;
    public $posts;
    public $search = "";
    public $post_type = "";
    public $item_type = [];
    public $mode_of_payment = [];
    public $delivery_date = "";

    // containers for results
    public $search_output = [];
    public $post_type_output = [];
    public $post_ids;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->post_ids = $this->user->save_posts->pluck('post_id');

    // Retrieve all posts that match the saved post IDs
        $this->posts =  Post::whereIn('id', $this->post_ids)->get();
    }

    public function applyFilter()
    {
        $query = Post::query();

        if (!empty($this->search)) {
            $query->where(function ($query) {
                $query->where('item_name', 'like', '%' . strtolower($this->search) . '%')
                      ->orWhere('item_origin', 'like', '%' . strtolower($this->search) . '%')
                      ->orWhere('meetup_place', 'like', '%' . strtolower($this->search) . '%');
            });
        }

        // Apply 'type' filter if it's not null or empty
        if (!empty($this->post_type)) {
            $query->where('type', strtolower($this->post_type));
        }

        // Apply 'item_type' filter if it's an array and not empty
        if (!empty($this->item_type) && is_array($this->item_type)) {
            $query->where(function ($innerQuery) {
                foreach ($this->item_type as $type) {
                    // Use raw SQL to decode the JSON column and check if the filter value exists in the decoded array
                    $innerQuery->orWhere('item_type', 'like', '%' . $type . '%');
                }
            });
        }

        // Apply 'mode_of_payment' filter if it's an array and not empty
        if (!empty($this->mode_of_payment) && is_array($this->mode_of_payment)) {
            $query->where(function ($innerQuery) {
                foreach ($this->mode_of_payment as $payment) {
                    $innerQuery->orWhere('mode_of_payment', 'like', '%' . $payment . '%');
                }
            });
        }

        // Apply 'delivery_date' filter if it's not null or empty
        if (!empty($this->delivery_date)) {
            $query->where('delivery_date', $this->delivery_date);
        }

        // Order results
        $this->posts = $query->orderByDesc('created_at')->get();
    }


    public function clearFilter()
    {
        $this->posts = Post::whereIn('id', $this->post_ids)->get();
    }

    public function render()
    {
        return view('livewire.saved', ['user' => $this->user, 'posts' => $this->posts]);
    }
}
