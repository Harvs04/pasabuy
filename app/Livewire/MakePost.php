<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Post;
use App\Models\Notification;
use Livewire\Component;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Log;

class MakePost extends Component
{   
    public User $user;
    public $type;
    public $item_name;
    public $item_origin;
    public $item_type = [];
    public $subtype = [];
    public $item_image;
    public $mode_of_payment = [];
    public $delivery_date;
    public $notes;

    // additional vars for transactions
    public $max_orders;
    public $cutoff_date_orders = null;
    public $transaction_fee;
    public $meetup_place;
    public $arrival_time = null;


    public function __construct() 
    {
        $this->user = User::where('id', Auth::user()->id)->firstOrFail();
    }

    public function createPost()
    {
        try {
            $this->type = ($this->user->role === 'customer') ? 'item_request' : 'transaction';

            $data = [
                'type' => $this->type,
                'user_id' => $this->user->id,
                'poster_name' => $this->user->name,
                'item_name' => $this->item_name,
                'item_origin' => $this->item_origin,
                'item_type' => json_encode($this->item_type),
                'sub_type' => empty($this->subtype) ? null : json_encode($this->subtype),
                'item_image' => $this->item_image ?: 'https://res.cloudinary.com/dflz6bik9/image/upload/v1738234575/Pasabuy-logo-no-name_knwf3t.png',
                'delivery_date' => $this->delivery_date,
                'arrival_time' => $this->arrival_time ?: null,
                'mode_of_payment' => json_encode($this->mode_of_payment),
                'transaction_fee' => $this->transaction_fee ?: null,
                'max_orders' => $this->max_orders ?: null,
                'cutoff_date' => $this->cutoff_date_orders ?: null,
                'meetup_place' => $this->meetup_place ?: null,
                'additional_notes' => $this->notes ?: null,
            ];
            $post = Post::create($data);

            Notification::create([
                'type' => $this->type === 'item_request' ? 'new item request' : 'new transaction',
                'post_id' => $post->id,
                'actor_id' => $this->user->id,
                'poster_id' => $this->user->id
            ]);

            ;
            session()->flash('create_post_success', 'Post created successfully!');
            return $this->redirect(route('dashboard'), true);
        } catch (\Throwable $th) {
            session()->flash('create_post_error', 'Failed to create post. Please try again.');
            return $this->redirect(route('dashboard'), true);
        }
    }
    public function render()
    {
        return view('livewire.make-post', ['user' => $this->user]);
    }
}
