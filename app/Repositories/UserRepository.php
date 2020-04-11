<?php

namespace App\Repositories;

use App\User;

class UserRepository
{
    /**
     * @var User
     */
    private User $_model;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->_model = $user;
    }

    /**
     * @return User
     */
    public function getUserModel(): User
    {
        return $this->_model;
    }
}
