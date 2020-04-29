<?php

namespace App\Notifications;

use App\Channels\TwilioSms;
use App\Notifications\Messages\SmsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddPatientRequest extends Notification
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
        return [TwilioSms::class];
    }

    /**
     * @param $notifiable
     * @return SmsMessage
     */
    public function toTwilioSms($notifiable): SmsMessage
    {
        return (new SmsMessage())
            ->setContent("Doctor wants to add you to his or her patient list. Please sign in to your account to accept the request.")
            ->setRecipient($notifiable->phone);
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
