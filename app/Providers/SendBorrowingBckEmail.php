<?php

namespace App\Providers;

use App\Providers\BorrowingBckEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendBorrowingBckEmail
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
     * @param  \App\Providers\BorrowingBckEvent  $event
     * @return void
     */
    public function handle(BorrowingBckEvent $event)
    {
        //
    }
}
