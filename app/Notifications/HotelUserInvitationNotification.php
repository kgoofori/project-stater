<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Mail\HotelMailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class HotelUserInvitationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $hotel = $notifiable->hotel;
        $mail =  (new HotelMailMessage($hotel))
                    ->subject('Invitation - '.$hotel->name)
                    ->greeting('Hello '.$notifiable->name  )
                    ->line($notifiable->user->name. ' has invited you to join the users of '.$hotel->name);

        if($notifiable->has_account){
            $mail = $mail->line('Please sign into your account and check the invitations to accept inviation')
                        ->action('Accept Invitation', url('/invitations/accept?token='.$notifiable->id));
        }else{
            $mail = $mail->line('Please create an account with us to accept invitation.')
                    ->action('Create Account ', url('/register'));
        }

        return $mail;

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
