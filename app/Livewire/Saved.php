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
        
        // Apply search filter
        if (!empty($this->search)) {
            $this->posts = $this->posts->filter(function ($post) {
                return stripos($post['item_name'], $this->search) !== false ||
                    stripos($post['item_origin'], $this->search) !== false ||
                    stripos($post['meetup_place'], $this->search) !== false;
            });
        }

        // Apply 'type' filter if it's not null or empty
        if (!empty($this->post_type)) {
            $this->posts = $this->posts->where('type', strtolower($this->post_type));
        }

        // Apply 'item_type' filter if it's an array and not empty
        if (!empty($this->item_type) && is_array($this->item_type)) {
            $this->posts = $this->posts->filter(function ($post) {
                foreach ($this->item_type as $type) {
                    if (stripos(json_encode($post['item_type']), $type) !== false) {
                        return true;
                    }
                }
                return false;
            });
        }

        // Apply 'mode_of_payment' filter if it's an array and not empty
        if (!empty($this->mode_of_payment) && is_array($this->mode_of_payment)) {
            $this->posts = $this->posts->filter(function ($post) {
                foreach ($this->mode_of_payment as $payment) {
                    if (stripos(json_encode($post['mode_of_payment']), $payment) !== false) {
                        return true;
                    }
                }
                return false;
            });
        }

        // Apply 'delivery_date' filter if it's not null or empty
        if (!empty($this->delivery_date)) {
            $this->posts = $this->posts->where('delivery_date', $this->delivery_date);
        }

        // Order results by created_at (descending)
        $this->posts = $this->posts->sortByDesc('created_at')->values(); // Re-index array

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
