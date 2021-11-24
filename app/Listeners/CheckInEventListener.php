<?php

namespace App\Listeners;

use App\Events\CheckInEvent;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\CheckInNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckInEventListener
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
     * @param  CheckInEvent  $event
     * @return void
     */
    public function handle(CheckInEvent $event)
    {
        $customer = $event->roomDetail->customer;

        $customer->notify(new CheckInNotification($event->roomDetail));
    }
}
