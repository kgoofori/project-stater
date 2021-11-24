<?php

namespace App\Listeners;

use App\Events\ReservationUpdatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\ReservationUpdatedNotification;

class ReservationUpdatedEventListener
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
     * @param  ReservationUpdatedEvent  $event
     * @return void
     */
    public function handle(ReservationUpdatedEvent $event)
    {
        $customer = $event->reservation->customer;

        $customer->notify(new ReservationUpdatedNotification($event->reservation));
    }
}
