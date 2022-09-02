<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $full_name;
    public $book_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($full_name,$book_name)
    {
        $this->full_name = $full_name;
        $this->book_name = $book_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('emails.borrow')
            ->subject('BorrowingEvent a book')
            ->from('info@libraly.org');
    }
}
