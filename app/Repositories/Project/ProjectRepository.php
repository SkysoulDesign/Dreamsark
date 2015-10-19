<?php

namespace DreamsArk\Repositories\Project;

use DreamsArk\Models\Project\Draft;
use DreamsArk\Models\Project\Project;
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
    public function __construct(Project $project)
    {
        $this->model = $project;
    }

    /**
     * Get all Model from the DB
     *
     * @param array $columns
     * @return mixed
     */
    public function all(array $columns = ['*'])
    {
        return $this->model->all($columns);
    }

    /**
     * Create a Idea
     *
     * @param int $user_id
     * @param int $type
     * @param array $fields
     * @return Project|Draft
     */
    public function create($user_id, $type, array $fields)
    {
        $project = $this->model
            ->setAttribute('user_id', $user_id)
            ->setAttribute('type', $type)
            ->fill($fields);
        $project->save();
        return $project;
    }

    /**
     * Get all Published projects by User
     *
     * @param int $user_id
     * @return Collection
     */
    public function publishedBy($user_id)
    {
        return $this->model->where(compact('user_id'))->get();
    }

    /**
     * Delete Model
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete()
    {
        return $this->model->delete();
    }

    /**
     * Set Model to Draft
     *
     * @param null|Draft $draft_id
     * @return ProjectRepository
     */
    public function draft($draft_id = null)
    {
        return $this->newInstance($draft_id, Draft::class);
    }

    /**
     * Returns This Model
     *
     * @return Project
     */
    public function get()
    {
        return $this->model;
    }

}