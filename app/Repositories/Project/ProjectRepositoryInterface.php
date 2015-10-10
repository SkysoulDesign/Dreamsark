<?php

namespace DreamsArk\Repositories\Project;

use DreamsArk\Models\Project;
use Illuminate\Support\Collection;

interface ProjectRepositoryInterface
{
    /**
     * Create a new Project on the Database
     *
     * @param array $fields
     * @param int $user_id
     * @return Project
     */
    public function attach(array $fields, $user_id);

    /**
     * Return all projects of an specified user
     *
     * @param int $user_id
     * @return Collection of Projects
     */
    public function userProjects($user_id);

    /**
     * Pledge a project
     *
     * @param int $project_id
     * @param int $user_id
     * @param int $amount
     * @return mixed
     */
    public function pledge($project_id, $user_id, $amount);

}