<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\User;
use App\Models\Notification;

class OrdersList extends Component
{
    public $user;
    public $orders;
    public $customer_id;
    public $provider_id;


    public function __construct()
    {
        $this->user = Auth::user();
        $this->orders = Order::all();
    }


    public function deleteOrder($order_id)
    {   
        try {
            $orderToDelete = Order::where('id', $order_id)->first();

            if (!$orderToDelete) {
                session()->flash('error', 'order not found.');
                return $this->redirect(route('order-list'));
            }

            $notifications = Notification::whereJsonContains('order_id', $order_id)->get();

            foreach ($notifications as $notification) {
                if ($notification->order_count === 1) {
                    $notification->delete();
                } else {
                    $orderIds = $notification->order_id; // Get current array
            
                    // Remove the specific order_id
                    $orderIds = array_filter($orderIds, function ($id) use ($order_id) {
                        return $id != $order_id;
                    });
                    $notification->order_id = array_values($orderIds); // Reindex
                    $notification->order_count -= 1;
                    $notification->save();
                }
            }

            $orderToDelete->delete();
            session()->flash('order_deleted', 'order deleted successfully.');
            return $this->redirect(route('order-list'));
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while deleting the order: ' . $e->getMessage());
            return $this->redirect(route('order-list'));
        } 
    }

    public function render()
    {
        $customer = null;
        $provider = null;

        if ($this->customer_id !== null) {
            $customer = User::where('id', $this->customer_id)->first();
        } 

        if ($this->provider_id !== null) {
            $provider = User::where('id', $this->provider_id)->first();
        }

        return view('livewire.orders-list', [
            'customer' => $customer,
            'provider' => $provider
        ]);
    }
}