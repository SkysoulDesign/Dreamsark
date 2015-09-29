<?php

namespace DreamsArk\Repositories\User;

use DreamsArk\Models\User;
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

    /**
     * Create a new User on the Database
     *
     * @param array $fields
     * @return User
     */
    public function create(array $fields)
    {
        return $this->model->create($fields);
    }
}