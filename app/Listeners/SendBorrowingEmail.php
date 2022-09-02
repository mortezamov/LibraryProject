<?php

namespace App\Listeners;

use App\Mail\BorrowMail;
use App\Models\Booker;
use App\Models\Borrow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendBorrowingEmail implements ShouldQueue
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @param $book_name
     * @param $borrow
     * @return void
     */
    public function handle($event)
    {
        $booker = Booker::find(1);
        Mail::to($booker->Email)
            ->send(new BorrowMail($booker->full_name,$event->book_name,$event->borrow));
    }
}
