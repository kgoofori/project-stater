<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use App\Events\ReservationConfirmedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\ReservationConfirmedNotification;

class ReservationConfirmedEventListener
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
     * @param  ReservationConfirmedEvent  $event
     * @return void
     */
    public function handle(ReservationConfirmedEvent $event)
    {
        $customer = $event->reservation->customer;

        $customer->notify(new ReservationConfirmedNotification($event->reservation));
    }
}
