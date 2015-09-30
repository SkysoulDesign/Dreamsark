<?php

namespace DreamsArk\Repositories\User;

use DreamsArk\Models\User;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    /**
     * Create a new User on the Database
     *
     * @param array $fields
     * @return User
     */
    public function create(array $fields);

    /**
     * Update a new User on the Database
     *
     * @param int $user_id
     * @param array $fields
     * @return User
     */
    public function update($user_id, array $fields);
}