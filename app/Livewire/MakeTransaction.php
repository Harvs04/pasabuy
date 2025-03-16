<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Notification;

class MakeTransaction extends Component
{
    public $post;

    public $item_name;
    public $item_origin;
    public $item_image;
    public $item_type;
    public $subtype = [];

    public $mode_of_payment = [];
    public $max_orders;
    public $cutoff_date_orders;
    public $delivery_date;
    public $transaction_fee;
    public $arrival_time;
    public $meetup_place;

    public function mount()
    {
        $this->item_origin = $this->post->item_origin;
    }

    public function makePost($item_name, $item_origin, $item_type, $subtype, $mode_of_payment)
    {
        try {
            $user = Auth::user();
            $new_post = [
                'type' => 'transaction',
                'user_id' => $user->id,
                'poster_name' => $user->name,
                'item_name' => $item_name,
                'item_origin' => $item_origin,
                'item_type' => json_encode($item_type),
                'sub_type' => $this->subtype ? json_encode($subtype) : null,
                'item_image' => $this->item_image ?: 'https://res.cloudinary.com/dflz6bik9/image/upload/v1738234575/Pasabuy-logo-no-name_knwf3t.png',
                'delivery_date' => $this->delivery_date,
                'arrival_time' => $this->arrival_time,
                'mode_of_payment' => json_encode($mode_of_payment),
                'transaction_fee' => $this->transaction_fee,
                'max_orders' => $this->max_orders,
                'cutoff_date' => $this->cutoff_date_orders,
                'meetup_place' => $this->meetup_place
            ];
            $post = Post::create($new_post);

            // update status of item request:
            $this->post->status = 'converted';
            $this->post->save();

            ;

            // notif for the poster of item request
            Notification::create([
                'type' => 'converted post',
                'post_id' => $this->post->id,
                'actor_id' => $user->id,
                'poster_id' => $this->post->user_id
            ]);

            // notif for the actor
            Notification::create([
                'type' => 'new transaction',
                'post_id' => $post->id,
                'actor_id' => $user->id,
                'poster_id' => $user->id
            ]);

            session()->flash('create_transaction_success', 'Transaction created successfully.');
            return $this->redirect(route('dashboard'), true);
        } catch (\Throwable $th) {
            session()->flash('create_post_error', 'Failed to create post. Please try again.');
            return $this->redirect(route('dashboard'), true);
        }
    }

    public function render()
    {
        return view('livewire.make-transaction');
    }
}
