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
     */
    public static function verify( string $code ): bool
    {
        $verificationCode = \App\VerificationCode::where('user_id', Auth::id())
            ->where('code', $code)
            ->first();

        if(is_null($verificationCode))
        {
            return false;
        }

        Auth::user()->update([
            'phone_verified_at' => date('Y-m-d H:i:s')
        ]);

        return true;
    }

    /**
     * @param string $code
     * @return \App\VerificationCode|null
     */
    public static function getVerificationCode( string $code ): ?\App\VerificationCode
    {
        return \App\VerificationCode::where('user_id', Auth::id())
            ->where('code', $code)
            ->first();
    }

    /**
     * @param \App\VerificationCode $verificationCode
     * @return bool
     * @throws \Exception
     */
    public static function isExpired( \App\VerificationCode $verificationCode ): bool
    {
        return self::isDateExpired($verificationCode->updated_at);
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
