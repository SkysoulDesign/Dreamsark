<?php

namespace DreamsArk\Repositories\User;

use DreamsArk\Models\User;
use DreamsArk\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

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