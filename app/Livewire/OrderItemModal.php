<?php

namespace App\Livewire;

use Livewire\Component;

class OrderItemModal extends Component
{

    public $post;
    public function render()
    {
        return view('livewire.order-item-modal');
    }
}
