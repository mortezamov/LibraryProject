<?php

namespace App\Events;

use App\Models\Borrow;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BorrowingEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $book_name;
    public $borrow;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($book_name,Borrow $borrow)
    {
        $this->book_name = $book_name;
        $this->borrow = $borrow;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
