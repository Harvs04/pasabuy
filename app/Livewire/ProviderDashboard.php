<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth; 
use Livewire\Component;

class ProviderDashboard extends Component
{
    public function render()
    {
        $user = Auth::user(); 
        return view('livewire.provider-dashboard', ['user' => $user]);
    }
}
