<?php

namespace App\Listeners;

use App\Mail\BorrowBackMail;
use App\Models\Booker;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendBorrowingBackEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $booker = Booker::find(1);
        Mail::to($booker->Email)
            ->send(new BorrowBackMail($booker->full_name,$event->book_name));
    }
}
