<?php

namespace App\Listeners;

use App\Notifications\VerifyPhoneNumber;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendPhoneVerificationCode
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        try {
            $verificationCode = \App\VerificationCode::create([
                'user_id' => $event->user->id,
                'code' => encrypt(\App\Services\VerificationCode::generate()),
                'expiration_date' => date(
                    'Y-m-d H:i:s',
                    strtotime("+2 minutes", strtotime(date('Y-m-d H:i:s')))
                )
            ]);

            $event->user->notify( new VerifyPhoneNumber($verificationCode->code) );
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
