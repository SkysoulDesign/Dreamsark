<?php

namespace DreamsArk\Repositories\Project;

use DreamsArk\Models\Project\Project;
use DreamsArk\Models\Project\Script;
use DreamsArk\Models\Project\Take;
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

    /**
     * Create a Script
     *
     * @param int $project_id
     * @return Script
     */
    public function createScript($project_id);

    /**
     * Create a Take
     *
     * @param int $script_id
     * @param array $fields
     * @return Take
     */
    public function createTake($script_id, array $fields);

}