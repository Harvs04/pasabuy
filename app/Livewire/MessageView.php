<?php

namespace App\Livewire;

use App\Models\Conversation;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Message;
use App\Models\User;
use App\Events\PrivateMessageEvent;
use Illuminate\Support\Facades\Log;

class MessageView extends Component
{

    public $user;
    public $convo_id;
    public $conversation;
    public $message = '';


    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function sendMessage($message, $receiver_id)
    {
        try {
            $new_message = [
                'conversation_id' => (int)$this->convo_id,
                'sender_id' => $this->user->id,
                'receiver_id' => $receiver_id,
                'message' => $message
            ];

            Message::create($new_message);

            // getting receiver user:
            $receiver = User::where('id', $receiver_id)->first();
            // update messages:
            if ($this->user->role === 'provider') {
                // $this->user->conversations_as_provider->push($new_message);
                $receiver->conversations_as_customer->push($new_message);
            } else if ($this->user->role === 'customer') {
                // $this->user->conversations_as_customer->push($new_message);
                $receiver->conversations_as_provider->push($new_message);
            }

            $userId = (int) $receiver_id;
            $senderId = Auth::user()->id;
            $message = $message ?? "You have new notification!"; 

            Log::info("Firing PrivateNotificationEvent for user {$userId} from sender {$senderId} with message: {$message}");
            broadcast(new PrivateMessageEvent($userId, $senderId, $message));
            Log::info("After PrivateNotificationEvent for user {$userId} from sender {$senderId} with message: {$message}");
            return redirect()->back()->with('success', "Notif sent to user{$userId}.");
        } catch (\Throwable $th) {
            session()->flash('error', 'An error occurred. Please try again.');
            return $this->redirect(route('message.view', ['convo_id' => (int)$this->convo_id]), true);  
        }
    }

    public function render()
    {   
        $this->conversation = Conversation::where('id', $this->convo_id)->first();
        $order = Order::where('id', $this->conversation->order_id)->first();
        return view('livewire.message-view', ['order' => $order, 'conversation' => $this->conversation]);
    }
}
