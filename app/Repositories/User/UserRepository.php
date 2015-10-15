<?php

namespace DreamsArk\Repositories\User;

use DreamsArk\Models\User\User;
use DreamsArk\Repositories\Repository;

class UserRepository extends Repository implements UserRepositoryInterface
{

    /**
     * @var User
     */
    public $model;

    /**
     * @param User $user
     */
    function __construct(User $user)
    {
        $this->model = $user;
    }

}