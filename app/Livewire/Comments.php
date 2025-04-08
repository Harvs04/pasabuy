<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\LikePost;
use App\Models\SavePost;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class Comments extends Component
{   
    public $user;
    public $post;
    public $comment = '';
    public $comments = [];
    public $user_likes;
    public $db_comments;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function mount()
    {
        $this->user_likes = LikePost::where('post_id', $this->post->id)->get();
        $this->db_comments = Comment::where('post_id', $this->post->id)->get();
    }

    public function refresh()
    {
        Auth::setUser($this->user);
    }

    public function likePost($post_id, $isLiked)
    {
        try {
            if ($isLiked) {
                $save_post = [
                    'post_id' => $post_id,
                    'user_id' => $this->user->id,
                    'liked_by' => $this->user->name, 
                ];
                LikePost::create($save_post);
    
                if ($this->user->id !== $this->post->user_id) {
                    Notification::create([
                        'type' => 'like',
                        'post_id' => $post_id,
                        'actor_id' => $this->user->id,
                        'poster_id' => $this->post->user_id
                    ]);
                }
            } else {
                LikePost::where('post_id', $post_id)->where('user_id', $this->user->id)->where('liked_by', $this->user->name)->delete();
            }
            $this->user_likes = LikePost::where('post_id', $this->post->id)->get();
        } catch (\Throwable $th) {
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('dashboard'), true);
        }
    }

    public function refreshComments($post_id)
    {
        $this->db_comments = Comment::where('post_id', $post_id)->get();
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="w-full px-2 py-4 border-t">
            <div class="w-full animate-pulse flex justify-between">
                <div class="w-24">
                    <div class="w-full h-2 bg-gray-500 rounded-full"></div>
                </div>
                <div class="w-10/12 flex gap-4">
                    <div class="w-1/3 h-2 bg-gray-500 rounded-full"></div>
                    <div class="w-1/3 h-2 bg-gray-500 rounded-full"></div>
                    <div class="w-1/3 h-2 bg-gray-500 rounded-full"></div>
                </div>
            </div>
        </div>
        HTML;
    }

    public function addComment($post_id)
    {   
        try {
            $new_comment = [
                'post_id' => $post_id,
                'user_id' => $this->user->id,
                'commenter' => $this->user->name,
                'comment' => $this->comment 
            ];
            Comment::create($new_comment);
    
            $this->refreshComments($post_id);

            if ($this->user->id !== $this->post->user_id) {
                Notification::create([
                    'type' => 'comment',
                    'post_id' => $post_id,
                    'actor_id' => $this->user->id,
                    'poster_id' => $this->post->user_id
                ]);
            }
        } catch (\Throwable $th) {
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('dashboard'), true);
        }
    }

    public function savePost($post_id, $isSaved)
    {
        try {
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
        } catch (\Throwable $th) {
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('dashboard'), true);
        }
    }
    
    
    public function render()
    {
        return view('livewire.comments');
    }
}
