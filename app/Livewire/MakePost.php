<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth; 

class MakePost extends Component
{   
    public $item_name = '';
    public $item_origin = '';
    public $item_type = [];
    public $mode_of_payment = [];
    public $delivery_date = '';
    public $notes = '';

    public function render()
    {
        $user = Auth::user();
        return view('livewire.make-post', ['user' => $user]);
    }
}
