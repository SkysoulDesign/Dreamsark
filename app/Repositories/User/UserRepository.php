<?php

namespace DreamsArk\Repositories\User;

use DreamsArk\Models\User\User;
use DreamsArk\Repositories\Repository;
use Illuminate\Support\Collection;

class UserRepository extends Repository implements UserRepositoryInterface
{

    /**
     * @var User
     */
    public $model;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Returns all drafts for this user
     *
     * @param int $user_id
     * @return Collection
     */
    public function drafts($user_id)
    {
        return $this->model($user_id)->drafts;
    }

}