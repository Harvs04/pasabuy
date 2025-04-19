<?php

namespace App\Livewire;

use App\Models\Notification;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;
use App\Models\User;
use App\Models\Post;

class ReportList extends Component
{   
    public $user;
    public $reports;
    public $sender_id;
    public $reported_id;
    public $post_id;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->reports = Report::all();
    }

    public function updateReport($selected_report_id, $status, $points_add, $points_minus)
    {   
        
        try {
            $selected_report = Report::where('id', $selected_report_id)->first();

            if (!$selected_report) {
                session()->flash('error', 'report not found.');
                return $this->redirect(route('report-list'));
            }

            $selected_report->status = $status;
            $selected_report->save();

            $sender_user = User::where('id', $this->sender_id)->first();
            $sender_user->pasabuy_points += $points_add;
            $sender_user->save();

            $reported_user = User::where('id', $this->reported_id)->first();
            $reported_user->pasabuy_points -= $points_minus;
            $reported_user->save();

            Notification::create([
                'type' => 'report resolved',
                'post_id' => $selected_report->post_id,
                'actor_id' => $selected_report->sender_id,
                'order_id' => $selected_report->id,
                'poster_id' => $selected_report->sender_id,
            ]);

            session()->flash('report_updated', 'Report updated successfully.');
            return $this->redirect(route('report-list'));
        } catch (\Exception $e) {
            session()->flash('error', 'report not found.');
            return $this->redirect(route('report-list'));
        } 
    }

    public function render()
    {
        $sender = null;
        $reported = null;
        $post = null;

        if ($this->sender_id !== null) {
            $sender = User::where('id', $this->sender_id)->first();
        } 

        if ($this->reported_id !== null) {
            $reported = User::where('id', $this->reported_id)->first();
        }

        if ($this->post_id !== null) {
            $post = Post::where('id', $this->post_id)->first();
        }

        return view('livewire.report-list', [
            'sender' => $sender,
            'reported' => $reported,
            'post' => $post
        ]);
    }
}
