<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth; 
use Livewire\Component;
use App\Models\User;
use App\Models\Post;

class Dashboard extends Component
{
    public User $user;
    public $all_posts;
    public $posts;
    public $search = "";
    public $post_type = "";
    public $item_type = [];
    public $mode_of_payment = [];
    public $delivery_date = "";

    // containers for results
    public $search_output = [];
    public $post_type_output = [];

    public function __construct()
    {
        $this->user = User::where('id', Auth::user()->id)->firstOrFail();
        $this->posts = Post::where('id', 'like', '%')->orderByDesc('created_at')->get();
        $this->all_posts = Post::where('id', 'like', '%')->orderByDesc('created_at')->get();
    }

    // navbar functions
    public function signOut() 
    {
        Auth::logout();
        return $this->redirect(route('login'), true);
    }

    // dashboard functions
    public function applyFilter()
    {
        $query = Post::query();

        if (!empty($this->search)) {
            $query->where(function ($query) {
                $query->where('item_name', 'like', '%' . strtolower($this->search) . '%')
                      ->orWhere('item_origin', 'like', '%' . strtolower($this->search) . '%')
                      ->orWhere('meetup_place', 'like', '%' . strtolower($this->search) . '%')
                      ->orWhere('sub_type', 'like', '%' . strtolower($this->search) . '%')
                      ->orWhere('poster_name', 'like', '%' . strtolower($this->search) . '%');
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
        $this->posts = $this->all_posts;
    }

    public function render()
    {
        $user = Auth::user(); 
        
        return view('livewire.dashboard', ['user' => $user, 'posts' => $this->posts]);
    }
}
