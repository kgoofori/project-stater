<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use App\Events\ReservationCancelledEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\ReservationCancelledNotification;

class ReservationCancelledEventListener
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
     * @param  ReservationCancelledEvent  $event
     * @return void
     */
    public function handle(ReservationCancelledEvent $event)
    {
        $customer = $event->reservation->customer;

        $customer->notify(new ReservationCancelledNotification($event->reservation));
    }
}
