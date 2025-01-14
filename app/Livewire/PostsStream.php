<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class PostsStream extends Component
{

    public $posts = [];

    public function __construct()
    {
        $this->posts = Post::all()->sortByDesc('created_at');
    }
    public function render()
    {
        return view('livewire.posts-stream');
    }
}
