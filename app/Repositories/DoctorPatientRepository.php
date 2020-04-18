<?php

namespace App\Repositories;

use App\DoctorPatient;

class DoctorPatientRepository
{
    /**
     * @var DoctorPatient
     */
    private DoctorPatient $_model;

    public function __construct(DoctorPatient $doctorPatient)
    {
        $this->_model = $doctorPatient;
    }

    /**
     * @param array $data
     * @return DoctorPatient
     */
    public function save(array $data): DoctorPatient
    {
        return $this->_model->create($data);
    }
}
