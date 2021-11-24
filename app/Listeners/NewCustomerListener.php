<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewCustomerListener
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $customer = HotelCustomer::where(['id' => $event->customer_id, 'is_customer' => false])->first();

        if($customer){
            $customer->update(['is_customer' => true]);

            //add customer to customers news letter and other things
        }
    }
}
