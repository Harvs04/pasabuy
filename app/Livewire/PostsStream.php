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

    public function placeholder()
    {
        return <<<'HTML'
            <div role="status" class="max-w-sm animate-pulse">
                <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-48 mb-4"></div>
                <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[360px] mb-2.5"></div>
                <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 mb-2.5"></div>
                <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[330px] mb-2.5"></div>
                <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[300px] mb-2.5"></div>
                <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[360px]"></div>
                <span class="sr-only">Loading...</span>
            </div>
        HTML;
    }

    public function render()
    {
        return view('livewire.posts-stream');
    }
}
