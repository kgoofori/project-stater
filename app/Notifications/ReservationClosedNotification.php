<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use App\Mail\HotelMailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReservationClosedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $reservation;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
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
        $hotel = $this->reservation->hotel;
        return (new HotelMailMessage($hotel))
                    ->from($hotel->email, $hotel->name)
                    ->greeting($notifiable->other_names ? 'Hello '.$notifiable->other_names.',' : 'Hello,')
                    ->line('Your reservation whith number '.$this->reservation->reserve_number.' was closed.')
                    ->line('Please call '.$hotel->phone.' or email '.$hotel->email.' for another reservation anytime')
                    ->line('We appreciate you for choosing us.');
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
