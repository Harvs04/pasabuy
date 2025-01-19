<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\SavePost;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Comments extends Component
{   
    public $user;
    public $post;
    public $comment = '';
    public $comments = [];
    public $db_comments;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function mount()
    {
        $this->db_comments = Comment::where('post_id', $this->post->id)->get();
    }

    public function refreshComments($post_id)
    {
        $this->db_comments = Comment::where('post_id', $post_id)->get();
    }


    public function addComment($post_id)
    {   
        $new_comment = [
            'post_id' => $post_id,
            'user_id' => $this->user->id,
            'commenter' => $this->user->name,
            'comment' => $this->comment 
        ];
        Comment::create($new_comment);

        $this->refreshSavedPost($post_id);
    }

    public function refreshSavedPosts()
    {
        Auth::setUser($this->user);
    }

    public function savePost($post_id, $isSaved)
    {
        if ($isSaved) {
            $save_post = [
                'post_id' => $post_id,
                'user_id' => $this->user->id,
                'saved_by' => $this->user->name, 
            ];
            SavePost::create($save_post);
        } else {
            SavePost::where('post_id', $post_id)->where('user_id', $this->user->id)->where('saved_by', $this->user->name)->delete();
        }
    }
    
    public function render()
    {
        return view('livewire.comments');
    }
}
