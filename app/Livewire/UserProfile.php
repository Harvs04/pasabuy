<?php

namespace App\Livewire;

use Livewire\Component;

class UserProfile extends Component
{
    public $id;
    public $user;


    public function mount()
    {
        $this->user = \App\Models\User::where('id', $this->id)->first();
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}
