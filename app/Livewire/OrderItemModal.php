<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Post;

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
                Transaction::create([
                    'post_id' => $this->post->id,
                    'customer_id' => $user->id,
                    'order' => $order,
                    'additional_notes' => $this->notes ? $this->notes : null
                ]);
            }

            $transaction = Post::where('id', $this->post->id)->firstOrFail();
            $transaction->order_count += count($this->orders);

            if ($transaction->order_count === $transaction->max_orders) {
                $transaction->status = 'full';
            }

            $transaction->save();
            sleep(1.5);
            
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
