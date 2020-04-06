<?php

namespace App\Notifications;

use App\Channels\TwilioSms;
use App\Notifications\Messages\SmsMessage;
use App\Traits\ToTwilioSms;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyPhoneNumber extends Notification
{
    use Queueable;

    /**
     * @var string
     */
    private $_verificationCode;

    /**
     * VerifyPhoneNumber constructor.
     * @param string $verificationCode
     */
    public function __construct(string $verificationCode)
    {
        $this->_verificationCode = $verificationCode;
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
    public function toTwilioSms($notifiable)
    {
        return (new SmsMessage())
            ->setContent("Your account verification code is {$this->_verificationCode}")
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
