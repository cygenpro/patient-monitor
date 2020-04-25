<?php

namespace App\Repositories;

use App\DoctorPatient;

class DoctorPatientRepository
{
    /**
     * @var DoctorPatient
     */
    private DoctorPatient $_model;

    /**
     * DoctorPatientRepository constructor.
     * @param DoctorPatient $doctorPatient
     */
    public function __construct(DoctorPatient $doctorPatient)
    {
        $this->_model = $doctorPatient;
    }

    /**
     * @param int $patientId
     * @param string $order
     * @return DoctorPatient|null
     */
    public function getNotAcceptedAndNotDeclinedByPatientId(int $patientId, string $order = 'ASC'): ?DoctorPatient
    {
        return $this->_model
            ->orderBy('created_at', $order)
            ->where('patient_id', $patientId)
            ->whereNull('accepted_at')
            ->whereNull('declined_at')
            ->with('doctor')
            ->first();
    }

    /**
     * @param int $requestId
     * @param int $patientId
     * @param string $order
     * @return DoctorPatient|null
     */
    public function getByIdAndPatient(int $requestId, int $patientId, string $order = 'ASC'): ?DoctorPatient
    {
        return $this->_model
            ->where('id', $requestId)
            ->where('patient_id', $patientId)
            ->orderBy('created_at', $order)
            ->first();
    }

    /**
     * @param array $data
     * @param int|null $requestId
     * @return DoctorPatient
     */
    public function save(array $data, int $requestId = null): DoctorPatient
    {
        if( is_null($requestId) )
        {
            $model = $this->_model->create($data);
        }
        else
        {
            $model = $this->_model->find($requestId);

            if( $model )
            {
                $model->update($data);
            }
        }


        return $model;
    }
}
