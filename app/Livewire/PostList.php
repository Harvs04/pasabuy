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

    public function deletePost($post_id)
    {   
        try {
            $postToDelete = Post::where('id', $post_id)->first();
            if ($postToDelete) {
                $postToDelete->delete();
                session()->flash('post_deleted', 'post deleted successfully.');
                return $this->redirect(route('post-list'));
            } else {
                session()->flash('error', 'post not found.');
                return $this->redirect(route('post-list'));
            }
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while deleting the post: ' . $e->getMessage());
            return $this->redirect(route('post-list'));
        } 
    }

    public function render()
    {
        return view('livewire.post-list');
    }
}
