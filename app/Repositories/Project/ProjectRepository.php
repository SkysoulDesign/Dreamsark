<?php

namespace DreamsArk\Repositories\Project;

use DreamsArk\Models\Project\Audition;
use DreamsArk\Models\Project\Cast;
use DreamsArk\Models\Project\Crew;
use DreamsArk\Models\Project\Project;
use DreamsArk\Models\Project\Script;
use DreamsArk\Models\Project\Take;
use DreamsArk\Repositories\RepositoryHelperTrait;
use Illuminate\Support\Collection;

class ProjectRepository implements ProjectRepositoryInterface
{

    use RepositoryHelperTrait;

    /**
     * @var Project
     */
    public $model;

    /**
     * @param Project $project
     * @internal param Take $take
     * @internal param Cast $cast
     * @internal param Crew $crew
     * @internal param Audition $audition
     */
    function __construct(Project $project)
    {
        $this->model = $project;
    }

    /**
     * Create a Idea
     *
     * @param int $user_id
     * @param int $stage
     * @return Project
     */
    public function create($user_id, $stage)
    {
        $project = $this->model->setAttribute('user_id', $user_id)->setAttribute('stage', $stage);
        $project->save();
        return $project;
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
        return $this->model($project_id)->script()->create([]);
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

    /**
     * Add Cast to Project
     *
     * @param int $project_id
     * @param array $fields
     * @return Cast
     */
    public function addCast($project_id, array $fields)
    {
        return $this->model($project_id)->cast()->create($fields);
    }

    /**
     * Associate User with Cast
     *
     * @param int $cast_id
     * @param int $user_id
     */
    public function attachCast($cast_id, $user_id)
    {
        return $this->cast->find($cast_id)->candidates()->attach($user_id);
    }

    /**
     * Add Crew to Project
     *
     * @param int $project_id
     * @param array $fields
     * @return Crew
     */
    public function addCrew($project_id, array $fields)
    {
        return $this->model($project_id)->crew()->create($fields);
    }

    /**
     * Associate User with Crew
     *
     * @param int $crew_id
     * @param int $user_id
     */
    public function attachCrew($crew_id, $user_id)
    {
        return $this->crew->find($crew_id)->candidates()->attach($user_id);
    }

    /**
     * returns all auditions
     *
     * @return Collection
     */
    public function auditions()
    {
        return $this->audition->all();
    }

}