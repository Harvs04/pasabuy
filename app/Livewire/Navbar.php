<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth; 
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Str;

class Navbar extends Component
{

    public User $user;
    public $currentUrl;
    public $post_id;

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
        $this->post_id = $id;
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
