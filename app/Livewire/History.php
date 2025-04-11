<?php
namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Order;

class History extends Component
{

    use WithPagination;

    public $user; 

    // sorting table
    public $f_order = ''; 
    public $f_provider = '';
    public $f_customer = '';
    public $f_ostatus = ''; 
    public $f_deliverydate = '';

    public function render()
    {
        $this->user = Auth::user();
        $list = $this->user->role === 'customer' ? Order::where('customer_id', $this->user->id)->whereIn('item_status', ['Delivered', 'Rated', 'Cancelled', 'Unavailable']) : Order::where('provider_id', $this->user->id)->whereIn('item_status', ['Delivered', 'Rated', 'Cancelled', 'Unavailable']);

        // Apply the sorting
        if (!empty($this->f_customer)) {
            $list = $list->join('users', 'orders.customer_id', '=', 'users.id')
            ->orderBy('users.name', $this->f_customer)
            ->select('orders.*'); 
        
        } elseif (!empty($this->f_provider)) {
            $list = $list->join('users', 'orders.provider_id', '=', 'users.id')
            ->orderBy('users.name', $this->f_provider)
            ->select('orders.*'); 
            
        } elseif (!empty($this->f_order)) {
            $list = $list->orderBy('order', $this->f_order);

        } elseif (!empty($this->f_ostatus)) {
            $list = $list->orderBy('item_status', $this->f_ostatus);

        } elseif (!empty($this->f_deliverydate)) {
            $list = $list->orderBy('date_delivered', $this->f_deliverydate);

        }

        $list = $list->get();

        return view('livewire.history', ['user' => $this->user, 'list' => $list]);
    }
}
