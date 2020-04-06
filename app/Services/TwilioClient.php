<?php

namespace App\Services;

use Twilio\Rest\Client;

abstract class TwilioClient
{
    /**
     * @var Client
     */
    private $_Client;

    /**
     * TwilioClient constructor.
     * @throws \Twilio\Exceptions\ConfigurationException
     */
    public function __construct()
    {
        $sid = config('twilio.account_sid');
        $token = config('twilio.auth_token');

        $this->_Client = new Client($sid, $token);
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->_Client;
    }
}
