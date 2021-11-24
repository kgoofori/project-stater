<?php

namespace App\Listeners;

use App\Events\ReservationCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\ReservationCreatedNotification;

class ReservationCreatedEventListener
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
     * @param  ReservationCreatedEvent  $event
     * @return void
     */
    public function handle(ReservationCreatedEvent $event)
    {
        $customer = $event->reservation->customer;

        $customer->notify(new ReservationCreatedNotification($event->reservation));
    }
}
