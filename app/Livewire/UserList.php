<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserList extends Component
{

    public $user;
    public $users;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->users = User::whereIn('role', ['customer', 'provider'])->latest()->get();
    }

    public function deleteUser($user)
    {   
        try {
            $userToDelete = User::where('id', $user['id'])->first();
            if ($userToDelete) {
                $userToDelete->delete();
                session()->flash('user_deleted', 'User deleted successfully.');
                return $this->redirect(route('user-list'));
            } else {
                session()->flash('error', 'User not found.');
                return $this->redirect(route('user-list'));
            }
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while deleting the user: ' . $e->getMessage());
            return $this->redirect(route('user-list'));
        } 
    }
    public function render()
    {
        return view('livewire.user-list');
    }
}
