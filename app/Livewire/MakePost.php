<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth; 

class MakePost extends Component
{   
    public $item_name = '';
    public $item_origin = '';
    public $item_type = [];
    public $item_image = '';
    public $mode_of_payment = [];
    public $delivery_date = '';
    public $notes = '';

    // additional vars for transactions
    public $max_orders = '';
    public $cutoff_date_orders = '';
    public $transaction_fee = '';
    public $meetup_place = '';
    public $arrival_time = '';
    public function createPost()
    {
        dd('hi');
    }
    public function render()
    {
        $user = Auth::user();
        return view('livewire.make-post', ['user' => $user]);
    }
}
