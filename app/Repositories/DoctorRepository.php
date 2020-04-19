<?php

namespace App\Repositories;

use App\Services\Role;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

class DoctorRepository extends UserRepository
{
    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return $this->getUserModel()
            ->where('role_id', Role::DOCTOR_ID);
    }

    /**
     * @param int $patientId
     * @param bool $isAccepted
     * @return Collection
     */
    public function getDoctorsByPatientId(int $patientId, bool $isAccepted = false): Collection
    {
        return $this->query()
            ->whereHas('patients', function ($q) use ($patientId, $isAccepted) {
                $q->where('patient_id', $patientId);

                if( $isAccepted ) {
                    $q->whereNotNull('accepted_at');
                }
            })
            ->get();
    }
}
