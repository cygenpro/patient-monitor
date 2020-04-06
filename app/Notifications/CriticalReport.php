<?php

namespace App\Notifications;

use App\Channels\TwilioSms;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CriticalReport extends Notification
{
    use Queueable;

    private $_patientId;

    /**
     * CriticalReport constructor.
     * @param int $patientId
     */
    public function __construct(int $patientId)
    {
        $this->_patientId = $patientId;
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
     */
    public function toTwilioSms($notifiable)
    {
        \App\Services\TwilioSms::sendSms(
            $notifiable->phone,
            "Patient #{$this->_patientId} reported critical data."
        );
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
