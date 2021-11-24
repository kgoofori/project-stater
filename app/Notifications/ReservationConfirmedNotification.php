<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use App\Mail\HotelMailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReservationConfirmedNotification extends Notification implements ShouldQueue
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
                    ->success()
                    ->from($hotel->email, $hotel->name)
                    ->greeting($notifiable->other_names ? 'Hello '.$notifiable->other_names.',' : 'Hello,')
                    ->line('Your reservation whith number <strong>'.$this->reservation->reserve_number.'</strong>  has been comfirmed.')
                    ->line('Please use the link below to check on your final invoice')
                    ->action('Invoice', 'https://invoices.dhcrm.app/'.$this->reservation->token)
                    ->line('You can also call '.$hotel->phone.' or email '.$hotel->email.' for more informtion')
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
