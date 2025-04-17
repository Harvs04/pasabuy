<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostList extends Component
{
    public $user;
    public $posts;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->posts = Post::all();
    }

    public function render()
    {
        return view('livewire.post-list');
    }
}
