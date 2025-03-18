<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Notification;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class MakeTransaction extends Component
{
    use WithFileUploads;

    public $post;

    public $item_name;
    public $item_origin;

    #[Validate('image|max:1024')]
    public $item_image; 
    public $default_image = false;
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
        if ($this->post->item_image === "https://res.cloudinary.com/dflz6bik9/image/upload/v1738234575/Pasabuy-logo-no-name_knwf3t.png") {
            $this->default_image = true;
        }
        $this->item_image = $this->post->item_image;
    }

    public function makePost($item_name, $item_origin, $item_type, $subtype, $mode_of_payment)
    {
        try {
            $user = Auth::user();

            if (!$this->default) {
                $imageUrl = Cloudinary::uploadFile($this->item_image->getRealPath())->getSecurePath();
            } else {
                // Default image if no file was uploaded
                $imageUrl = 'https://res.cloudinary.com/dflz6bik9/image/upload/v1738234575/Pasabuy-logo-no-name_knwf3t.png';
            }

            $new_post = [
                'type' => 'transaction',
                'user_id' => $user->id,
                'poster_name' => $user->name,
                'item_name' => $item_name,
                'item_origin' => $item_origin,
                'item_type' => json_encode($item_type),
                'sub_type' => $this->subtype ? json_encode($subtype) : null,
                'item_image' => $imageUrl,
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
