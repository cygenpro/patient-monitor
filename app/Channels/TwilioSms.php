<?php

namespace App\Channels;

use App\Notifications\Messages\SmsMessage;
use Illuminate\Notifications\Notification;

class TwilioSms
{
    /**
     * @param $notifiable
     * @param Notification $notification
     * @throws \Twilio\Exceptions\ConfigurationException
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toTwilioSms($notifiable);

        if( !($message instanceof SmsMessage) )
        {
            return;
        }

        (new \App\Services\TwilioSms())->sendSms(
            $message->getRecipient(),
            $message->getContent()
        );
    }
}
