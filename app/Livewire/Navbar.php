<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth; 
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Notification;

class Navbar extends Component
{

    public User $user;
    public $currentUrl;
    public $notif_instance;
    public $notif_id;
    public $post_in_notif;
    public $actor;

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

        ;
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
        $this->actor = User::where('id', $this->notif_instance->actor_id)->first();
        $this->post_in_notif = Post::where('id', $this->notif_instance->post_id)->first();
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
