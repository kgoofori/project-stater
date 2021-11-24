<?php

namespace App\Listeners;

use App\Events\CheckOutEvent;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\CheckOutNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckOutEventListener
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
     * @param  CheckOutEvent  $event
     * @return void
     */
    public function handle(CheckOutEvent $event)
    {
        $customer = $event->roomDetail->customer;

        $customer->notify(new CheckOutNotification($event->roomDetail));
    }
}
