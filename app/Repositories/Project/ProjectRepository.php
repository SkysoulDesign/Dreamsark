<?php

namespace DreamsArk\Repositories\Project;

use DreamsArk\Models\Project;
use DreamsArk\Repositories\Repository;
use Illuminate\Support\Collection;

class ProjectRepository extends Repository implements ProjectRepositoryInterface
{

    /**
     * @var Project
     */
    public $model;

    /**
     * @param Project $project
     */
    function __construct(Project $project)
    {
        $this->model = $project;
    }

    /**
     * Create a new entry on the Database
     *
     * @param array $fields
     * @param int $user_id
     * @return Project
     */
    public function attach(array $fields, $user_id)
    {
        $this->model->fill($fields)->setAttribute('user_id', $user_id)->save();
        return $this->model;
    }

    /**
     * Return all projects of an specified user
     *
     * @param int $user_id
     * @return Collection of Projects
     */
    public function userProjects($user_id)
    {
        return $this->model->where(compact('user_id'))->get();
    }

    /**
     * Pledge a project
     *
     * @param int $project_id
     * @param int $user_id
     * @param int $amount
     * @return mixed
     */
    public function pledge($project_id, $user_id, $amount)
    {
        $this->model($project_id)->backers()->attach($user_id, compact('amount'));
    }

}