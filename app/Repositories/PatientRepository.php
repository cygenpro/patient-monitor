<?php

namespace App\Repositories;

use App\Services\Role;
use App\User;

class PatientRepository extends UserRepository
{
    /**
     * PatientRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    /**
     * @param string $phoneNumber
     * @return User|null
     */
    public function getByPhone( string $phoneNumber ): ?User
    {
        return $this->getUserModel()
            ->where('role_id', Role::PATIENT_ID)
            ->where('phone', $phoneNumber)
            ->first();
    }
}
