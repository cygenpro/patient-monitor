<?php

namespace App\Services;

use App\User;
use Illuminate\Support\Facades\Auth;

class VerificationCode
{
    /**
     * @return string
     */
    public static function generate(): string
    {
        $code = '';

        for($i = 0; $i < 6; $i++)
        {
            $code .= rand(0, 9);
        }

        return $code;
    }

    /**
     * @param string $code
     * @return bool
     * @throws \Exception
     */
    public static function verify( string $code ): bool
    {
        $verificationCodes = \App\VerificationCode::where('user_id', Auth::id())->get();

        $match = false;

        foreach ($verificationCodes as $verificationCode)
        {
            $decryptedCode = $verificationCode->code;
            if( $decryptedCode == $code )
            {
                if( !self::isDateExpired($verificationCode->updated_at) )
                {
                    $match = true;
                }
            }
        }

        if($match)
        {
            Auth::user()->update([
                'phone_verified_at' => date('Y-m-d H:i:s')
            ]);
        }

        return $match;
    }


    /**
     * @param string $date
     * @return bool
     * @throws \Exception
     */
    private static function isDateExpired(string $date): bool
    {
        $futureDateTime = date(
          'Y-m-d H:i:s',
          strtotime('+22 minutes', strtotime($date))
        );

        $currentDateTime = date('Y-m-d H:i:s');

        $date1 = new \DateTime($futureDateTime);
        $date2 = new \DateTime($currentDateTime);

        return $date1 < $date2;
    }
}
