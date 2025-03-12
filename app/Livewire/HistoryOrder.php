<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Rating;
use App\Models\Notification;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;

class HistoryOrder extends Component
{

    public $user;
    public $order; 
    public $star_rating = 0;
    public $remarks;
    public $convo_id;
    public $has_rating;
    public $rating_instance;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function mount()
    {
        $this->has_rating = Rating::where('order_id', $this->order->id)->exists();
        if ($this->has_rating) {
            $this->rating_instance = Rating::where('order_id', $this->order->id)->first();
        }
    }

    public function rateTransaction()
    {
        try {
            $this->order->item_status = 'Rated';
            $this->order->save();

            $rating = [
                'post_id' => $this->order->post_id,
                'order_id' => $this->order->id,
                'provider_id' => $this->order->provider_id,
                'customer_id' => $this->order->customer_id,
                'star_rating' => $this->star_rating, 
                'remarks' => $this->remarks
            ];

            Rating::create($rating);
            Notification::create([
                'type' => 'item rated',
                'post_id' => $this->order->post_id,
                'actor_id' => $this->order->customer_id,
                'poster_id' => $this->order->provider_id
            ]);

            
            session()->flash('item_rated_success', 'Transaction rated!');
            return $this->redirect(route('history.view', ['order_id' => $this->order->id]), true);
        } catch (\Throwable $th) {
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('history.view', ['order_id' => $this->order->id]), true);
        }
    }
    
    public function render()
    {
        $transaction = Post::where('id', $this->order->post_id)->first();
        $this->convo_id = Conversation::where('provider_id', $this->order->provider_id)->where('customer_id', $this->order->customer_id)->first()->id;
        return view('livewire.history-order', ['transaction' => $transaction, 'convo_id' => $this->convo_id]);
    }
}
