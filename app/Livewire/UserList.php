<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserList extends Component
{

    public $user;
    public $users;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->users = User::all();
    }
    public function render()
    {
        return view('livewire.user-list');
    }
}
