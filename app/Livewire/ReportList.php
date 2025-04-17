<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;

class ReportList extends Component
{   
    public $user;
    public $reports;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->reports = Report::all();
    }

    public function render()
    {
        return view('livewire.report-list');
    }
}
