<?php

namespace App\Services;

class Role
{
    const DOCTOR_ID  = 1;
    const PATIENT_ID = 2;

    /**
     * @return array
     */
    public static function getIds(): array
    {
        return [self::DOCTOR_ID, self::PATIENT_ID];
    }
}
