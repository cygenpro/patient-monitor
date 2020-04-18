<?php

namespace App\Repositories;

use App\Services\Role;
use Illuminate\Support\Collection;

class DoctorRepository extends UserRepository
{
    public function query()
    {
        return $this->getUserModel()
            ->where('role_id', Role::DOCTOR_ID);
    }
}
