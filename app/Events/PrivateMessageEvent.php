<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PrivateMessageEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $senderId;
    public $convoId;
    public $message;
    public $imageUrl;
    public $createdAt;
    /**
     * Create a new event instance.
     */
    public function __construct($userId, $senderId, $convoId, $message, $imageUrl, $createdAt)
    {
        $this->userId = $userId;
        $this->senderId = $senderId;
        $this->convoId = $convoId;
        $this->message = $message;
        $this->imageUrl = $imageUrl;
        $this->createdAt = $createdAt;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn()
    {
        return new PrivateChannel("user.{$this->userId}");
        
    }

    public function broadcastAs()
    {
        return 'private-message';
        
    }


    public function broadcastWith()
    {
        return ['message' => $this->message, 'sender_id' => $this->senderId, 'convo_id' => $this->convoId, 'image_url' => $this->imageUrl, 'created_at' => $this->createdAt];
    }
}
