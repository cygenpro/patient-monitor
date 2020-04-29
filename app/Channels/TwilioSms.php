<?php

namespace App\Channels;

use App\Notifications\Messages\SmsMessage;
use Illuminate\Notifications\Notification;
use App\Services;

class TwilioSms
{
    /**
     * @param $notifiable
     * @param Notification $notification
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toTwilioSms($notifiable);

        (new Services\TwilioSms())->sendSms(
            $message->getRecipient(),
            $message->getContent()
        );
    }
}
