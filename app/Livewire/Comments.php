<?php

namespace App\Livewire;

use Livewire\Component;

class Comments extends Component
{

    public $comment = '';

    public function addComment()
    {
        
    }
    
    public function render()
    {
        return view('livewire.comments');
    }
}
