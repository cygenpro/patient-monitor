<?php
// Twilio Notify
// Alexa skill
// RPi realtime monitoring
namespace App\Providers;

use App\Events\DoctorRequestAccepted;
use App\Events\DoctorRequestDeclined;
use App\Events\PatientAssignedToDoctor;
use App\Events\RecordSubmitted;
use App\Events\ResendVerificationCodeRequested;
use App\Listeners\NotifyAddPatientRequest;
use App\Listeners\SendPhoneVerificationCode;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendPhoneVerificationCode::class
        ],
        ResendVerificationCodeRequested::class => [
            SendPhoneVerificationCode::class
        ],
        PatientAssignedToDoctor::class => [
            NotifyAddPatientRequest::class
        ],
        RecordSubmitted::class => [

        ],
        DoctorRequestAccepted::class => [

        ],
        DoctorRequestDeclined::class => [

        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
