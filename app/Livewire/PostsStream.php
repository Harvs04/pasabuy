<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Report;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class PostsStream extends Component
{

    public User $user;
    public $posts;
    public $type;
    public $complaint = '';
    public $post_id;
    public $reported_id;

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
            <div role="status" class="max-w-sm animate-pulse p-4">
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

    public function reportUser($post_id, $reported_id, $complaint_type) {
        try {

            $report = [
                'sender_id' => $this->user->id,
                'reported_id' => $reported_id,
                'post_id' => $post_id,
                'type' => $complaint_type,
                'complaint' => $this->complaint
            ];
            $new_report = Report::create($report);
            // dd(['id' => $new_report->id]);

            $notif = [
                'type' => 'report added',
                'post_id' => $post_id,
                'order_id' => $new_report->id,
                'actor_id' => $this->user->id,
                'poster_id' => $this->user->id,
            ];
            Notification::create($notif);
            // dd('notif na');
            session()->flash('report_user_success', 'Report added!');
            return $this->redirect(route('dashboard'), true);
        } catch (\Throwable $th) {
            dd($th);
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('dashboard'), true);
        }
    }

    public function render()
    {
        return view('livewire.posts-stream');
    }
}
