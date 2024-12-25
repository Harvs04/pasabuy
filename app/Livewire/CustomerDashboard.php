<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth; // Correct namespace for Auth
use Livewire\Component;

class CustomerDashboard extends Component
{
    public function render()
    {
        $user = Auth::user(); // Get the logged-in user
        return view('livewire.customer-dashboard', ['user' => $user]);
    }
}
