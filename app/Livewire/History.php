<?php
namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class History extends Component
{

    use WithPagination;

    public $user; 

    public function render()
    {
        $this->user = Auth::user();
        
        return view('livewire.history', ['user' => $this->user]);
    }
}
