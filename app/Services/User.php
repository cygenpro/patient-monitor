<?php

namespace App\Services;

use App\Repositories\DoctorRepository;
use App\Repositories\PatientRepository;
use Illuminate\Support\Collection;

class User
{
    /**
     * @param int $doctorId
     * @param bool $isAccepted
     * @return Collection
     */
    public static function getPatientUsersByDoctorId(int $doctorId, bool $isAccepted = false): Collection
    {
        $patientRepo = new PatientRepository( new \App\User() );

        return $patientRepo->getPatientsByDoctorId($doctorId, $isAccepted);
    }
}
