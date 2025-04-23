<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;

class CommentList extends Component
{

    public $comments; 
    public $post_id;
    public $comment_id;

    public function __construct()
    {
        $this->comments = Comment::latest()->get();
    }

    public function deleteComment($selected_comment_id)
    {
        try {
            $comment = Comment::where('id', $selected_comment_id)->first();

            if (!$comment) {
                session()->flash('error', 'Comment not found.');
                return $this->redirect(route('comment-list'), true);
            }
            
            $comment->delete();
            session()->flash('comment_deleted', 'Comment deleted successfully.');
            return $this->redirect(route('comment-list'), true);
            
        } catch (\Throwable $th) {
            session()->flash('error', 'Comment not found.');
            return $this->redirect(route('comment-list'), true);
        }
    }

    public function render()
    {
        return view('livewire.comment-list');
    }
}
