<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Mail\HotelMailMessage;
use App\Models\ReservationDetail;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckInNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $roomDetail;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ReservationDetail $roomDetail)
    {
        $this->roomDetail = $roomDetail;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $hotel = $this->roomDetail->hotel;
        
        return (new HotelMailMessage($hotel))
                    ->success()
                    ->from($hotel->email, $hotel->name)
                    ->greeting('Hello '.$notifiable->other_names.',')
                    ->line('Welcome to '.$hotel->name)
                    ->line('Please call '.$hotel->phone.' or email '.$hotel->email.' for any assistance')
                    ->line('We hope you have a delightful stay');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
