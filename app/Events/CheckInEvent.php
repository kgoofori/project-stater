<?php

namespace App\Events;

use App\Models\ReservationDetail;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CheckInEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $roomDetail;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ReservationDetail $roomDetail)
    {
        $this->roomDetail = $roomDetail;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
