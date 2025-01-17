<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Comments extends Component
{   
    public $user;
    public $post = '';
    public $comment = '';
    public $comments = [];

    public function __construct()
    {
        $this->user = Auth::user();
        // $this->comments = Comment::where(); // Uncomment and complete as needed
    }


    public function addComment($post_id, $user_id)
    {   
        $new_comment = [
            'post_id' => $post_id,
            'user_id' => $user_id,
            'comment' => $this->comment 
        ];
        Comment::create($new_comment);
    }
    
    public function render()
    {
        return view('livewire.comments');
    }
}
