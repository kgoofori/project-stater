<?php

namespace App\Listeners;

use App\Events\ReservationClosedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\ReservationClosedNotification;

class ReservationClosedEventListener
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
     * @param  ReservationClosedEvent  $event
     * @return void
     */
    public function handle(ReservationClosedEvent $event)
    {
        $customer = $event->reservation->customer;

        $customer->notify(new ReservationClosedNotification($event->reservation));
    }
}
