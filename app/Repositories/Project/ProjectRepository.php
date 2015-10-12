<?php

namespace DreamsArk\Repositories\Project;

use DreamsArk\Models\Project\Project;
use DreamsArk\Models\Project\Script;
use DreamsArk\Models\Project\Take;
use DreamsArk\Repositories\Repository;
use Illuminate\Support\Collection;

class ProjectRepository extends Repository implements ProjectRepositoryInterface
{

    /**
     * @var Project
     */
    public $model;

    /**
     * @var Script
     */
    private $script;
    /**
     * @var Take
     */
    private $take;

    /**
     * @param Project $project
     * @param Script $script
     * @param Take $take
     */
    function __construct(Project $project, Script $script, Take $take)
    {
        $this->model = $project;
        $this->script = $script;
        $this->take = $take;
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

    /**
     * Create a Script
     *
     * @param int $project_id
     * @return Script
     */
    public function createScript($project_id)
    {
        $script = $this->script->setAttribute('project_id', $project_id);
        $script->save();
        return $script;
    }

    /**
     * Create a Take
     *
     * @param int $script_id
     * @param array $fields
     * @return Take
     */
    public function createTake($script_id, array $fields)
    {
        $take = $this->take->setAttribute('script_id', $script_id);
        $take->fill($fields);
        $take->save();
        return $take;
    }


}