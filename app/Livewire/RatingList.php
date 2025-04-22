<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Rating;
use App\Models\User;

class RatingList extends Component
{
    public $feedbacks;
    public $customer_id;
    public $provider_id;
    public $feedback_id;

    public function __construct()
    {
        $this->feedbacks = Rating::latest()->get();
    }


    public function deleteFeedback()
    {   
        try {
            if ($this->feedback_id !== null) {
                $feedback = Rating::where('id', $this->feedback_id)->first();
            }

            $feedback->delete();
            session()->flash('feedback_deleted', 'feedback deleted successfully.');
            return $this->redirect(route('feedback-list'));
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while deleting the feedback: ' . $e->getMessage());
            return $this->redirect(route('feedback-list'));
        } 
    }

    public function render()
    {
        $customer = null;
        $provider = null;
        $feedback = null;

        if ($this->customer_id !== null) {
            $customer = User::where('id', $this->customer_id)->first();
        } 

        if ($this->provider_id !== null) {
            $provider = User::where('id', $this->provider_id)->first();
        }

        if ($this->feedback_id !== null) {
            $feedback = Rating::where('id', $this->feedback_id)->first();
        }

        return view('livewire.rating-list', [
            'customer' => $customer,
            'provider' => $provider,
            'selected_feedback' => $feedback,
        ]);
    }
}
