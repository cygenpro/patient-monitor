<?php

namespace App\Services;

use App\DoctorPatient;
use App\Repositories\DoctorPatientRepository;
use Illuminate\Support\Facades\Auth;

class DoctorRequest
{
    /**
     * @var DoctorPatientRepository
     */
    protected DoctorPatientRepository $_doctorPatientRepo;

    /**
     * DoctorRequest constructor.
     * @param DoctorPatientRepository $doctorPatientRepository
     */
    public function __construct(DoctorPatientRepository $doctorPatientRepository)
    {
        $this->_doctorPatientRepo = $doctorPatientRepository;
    }

    /**
     * @param int $doctorId
     * @param int $patientId
     * @return DoctorPatient|null
     */
    public function accept(int $doctorId, int $patientId): ?DoctorPatient
    {
        $doctorPatient = $this->_doctorPatientRepo->getByIdAndPatient($doctorId, $patientId);

        if( $doctorPatient && !$doctorPatient->accepted_at )
        {
            $doctorPatient->accepted_at = date('Y-m-d H:i:s');
            $doctorPatient->save();
        }

        return $doctorPatient;
    }

    /**
     * @param int $requestId
     * @param int $patientId
     * @return DoctorPatient|null
     */
    public function decline(int $requestId, int $patientId): ?DoctorPatient
    {
        $doctorPatient = $this->_doctorPatientRepo->getByIdAndPatient($requestId, $patientId);

        if( $doctorPatient && !$doctorPatient->declined_at )
        {
            $doctorPatient->declined_at = date('Y-m-d H:i:s');
            $doctorPatient->save();
        }

        return $doctorPatient;
    }

    /**
     * @param int $patientId
     * @return array|null
     */
    public function getPendingRequest(int $patientId): ?array
    {
        $data = [];

        $doctorPatient = $this->_doctorPatientRepo->getNotAcceptedAndNotDeclinedByPatientId( $patientId );

        if($doctorPatient)
        {
            $data['doctor_id']  = $doctorPatient->id;
            $data['doctor_name'] = $doctorPatient->doctor->name;
        }

        return !empty($data) ? $data : null;
    }
}
