<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BorrowingBackEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $book_name;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($book_name)
    {
        $this->book_name = $book_name;
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
