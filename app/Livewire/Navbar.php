<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth; 
use Livewire\Component;
use App\Models\User;
use App\Models\Post;
use App\Models\Notification;
use App\Models\LikePost;
use App\Models\Conversation;
use App\Models\Order;

class Navbar extends Component
{

    public User $user;
    public $currentUrl;
    public $notif_instance;
    public $notif_id;
    public $notif_type;
    public $like_count;
    public $post_in_notif;
    public $actor;
    public $order;
    public $convo_id;

    public function mount()
    {
        $this->currentUrl = url()->current();
    }

    public function __construct()
    {
        $this->user = User::where('id', Auth::user()->id)->firstOrFail();
    }

    public function switchRole()
    {
        $user = $this->user;
        $user->role === 'customer' ? $user->role = 'provider' : $user->role = 'customer'; 
        $user->save();

        session()->flash('change_role_success', "You are now logged in as " . ucwords($user->role) . ".");
        
        if (str_contains($this->currentUrl, 'transactions')) {
            return redirect(route('my-orders'), true);
        } elseif (str_contains($this->currentUrl, 'my-orders')) {
            return redirect(route('transactions'), true);
        } elseif (str_contains($this->currentUrl, 'messages')) {
            return redirect(route('messages'), true);
        } 

        return redirect(request()->header('Referer'));
    }

    public function openNotif($id)
    {
        $this->notif_id = $id;
        $this->fetchNotif();
    }


    public function fetchNotif()
    {
        $this->notif_instance = Notification::where('id', $this->notif_id)->first();
        $this->notif_type = $this->notif_instance->type;
        $this->actor = User::where('id', $this->notif_instance->actor_id)->first();
        $this->post_in_notif = Post::where('id', $this->notif_instance->post_id)->first();
        $this->order = Order::where('id', $this->notif_instance->order_id)->first();
        $this->like_count = LikePost::where('post_id', $this->post_in_notif->id)->get()->count();

        if (!in_array($this->notif_type, ['like', 'comment', 'new item request', 'new transaction', 'converted post'])) {
            $this->convo_id = Conversation::where('provider_id', $this->order->provider_id)->where('customer_id', $this->order->customer_id)->first()->id;
        }
    }
    

    public function signOut() 
    {
        Auth::logout();
        return $this->redirect(route('login'), true);
    }

    public function updateIsSeen()
    {
        foreach($this->user->notification_as_poster as $notif) {
            $notif->isSeen = true;
            $notif->save();
        }
    }

    public function render()
    {
        return view('livewire.navbar');
    }
}
