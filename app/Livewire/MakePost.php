<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth; 

class MakePost extends Component
{   
    public function render()
    {
        $user = Auth::user();
        return view('livewire.make-post', ['user' => $user]);
    }
}
