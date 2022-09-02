<?php

namespace App\Providers;

use App\Events\BorrowingBackEvent;
use App\Events\BorrowingEvent;
use App\Listeners\SendBorrowingBackEmail;
use App\Listeners\SendBorrowingEmail;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
//        Registered::class => [
//            SendEmailVerificationNotification::class,
//        ],
        BorrowingEvent::class => [
            SendBorrowingEmail::class,
        ],
        BorrowingBackEvent::class => [
            SendBorrowingBackEmail::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
