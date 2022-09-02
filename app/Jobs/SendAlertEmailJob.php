<?php

namespace App\Jobs;

use App\Mail\AlertMail;
use App\Mail\BorrowMail;
use App\Models\Borrow;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use function PHPUnit\Framework\isNull;

class SendAlertEmailJob implements ShouldQueue
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
     * @return void
     */
    public function handle()
    {
        Log::debug('payam',[$this->borrow->borrow_back_date]);
        if(empty($this->borrow->borrow_back_date)) {
            $booker = $this->borrow->booker;
            $book = $this->borrow->book;
            Mail::to($booker->Email)
                ->send(new AlertMail($booker->full_name, $book->book_name, $this->borrow));
        }
    }
}
