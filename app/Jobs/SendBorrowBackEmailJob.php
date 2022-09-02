<?php

namespace App\Jobs;

use App\Mail\BorrowBackMail;
use App\Mail\PenaltyMail;
use App\Models\Booker;
use App\Models\Borrow;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendBorrowBackEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $borrow;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($borrow_id)
    {
        $this->borrow = Borrow::query()->find($borrow_id);
    }

    /**
     * Execute the job.
     *
     * @param $book_name
     * @return void
     */
    public function handle(): void
    {
        $booker = $this->borrow->booker;
        $book = $this->borrow->book;
        Mail::to($booker->Email)->send(new BorrowBackMail($booker->full_name,$book->book_name));
        if($this->borrow->borrow_back_date > $this->borrow->should_return_at) {
            Mail::to($booker->Emial)->send(new PenaltyMail($booker->full_name,$book->book_name,$this->borrow));
        }
    }
}
