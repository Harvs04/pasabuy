<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Post;
use App\Models\Notification;
use App\Models\Conversation;
use App\Models\Message;

class OrderItemModal extends Component
{

    public $post;
    public $orders = [];
    public $notes = '';

    public function addOrder()
    {   
        try {
            $user = Auth::user();
            foreach($this->orders as $order) {
                $newOrder = Order::create([
                    'post_id' => $this->post->id,
                    'provider_id' => $this->post->user_id,
                    'customer_id' => $user->id,
                    'order' => $order,
                    'additional_notes' => $this->notes ? $this->notes : null
                ]);

                // checking if a converstation already exists
                $conversation = Conversation::
                            where('provider_id', $this->post->user_id)
                            ->where('customer_id', $user->id)
                            ->first();

                // if there's no conversation:
                if (!$conversation) {

                    // new convo
                    $newConvo = Conversation::create([
                        'post_id' => $this->post->id,
                        'order_id' => $newOrder->id,
                        'provider_id' => $this->post->user_id,
                        'customer_id' => $user->id
                    ]);

                    // initial message
                    Message::create([
                        'conversation_id' => $newConvo->id,
                        'sender_id' => $user->id,
                        'receiver_id' => $this->post->user_id,
                        'message' => 'I have placed an order in your transaction.'
                    ]);
                }
            }

            $transaction = Post::where('id', $this->post->id)->firstOrFail();
            // $transaction->order_count += count($this->orders);

            if (count($transaction->orders) === $transaction->max_orders) {
                $transaction->status = 'full';
            }

            $transaction->save();
            ;


            // make a notification
            Notification::create([
                'type' => 'new order',
                'post_id' => $this->post->id,
                'actor_id' => $user->id,
                'poster_id' => $this->post->user_id,
                'order_count' => count($this->orders)
            ]);

            // make a notification
            Notification::create([
                'type' => 'new order',
                'post_id' => $this->post->id,
                'actor_id' => $user->id,
                'poster_id' => $user->id,
                'order_count' => count($this->orders)
            ]);
            
            session()->flash('order_added', 'Order added successfully!');
            return $this->redirect(route('dashboard'), true);
        } catch (\Throwable $th) {
            session()->flash('order_add_error', 'Failed to add order. Please try again later.');
            return $this->redirect(route('dashboard'), true);
        }
    }

    public function render()
    {
        return view('livewire.order-item-modal');
    }
}
