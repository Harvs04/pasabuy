<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PostsStream extends Component
{

    public User $user;
    public $posts;
    public $type;

    public function __construct()
    {
        $this->user = User::where('id', Auth::user()->id)->first();
    }

    public function mount($posts)
    {
        $this->posts = $posts;
    }

    public function render()
    {
        return view('livewire.posts-stream');
    }
}
