<?php

namespace DreamsArk\Repositories\Project;

use DreamsArk\Models\Project\Draft;
use DreamsArk\Models\Project\Idea\Idea;
use DreamsArk\Models\Project\Project;
use DreamsArk\Repositories\RepositoryHelperTrait;
use Illuminate\Database\Eloquent\Model;
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
     * Get all Model from the DB
     *
     * @param array $columns
     * @return mixed
     */
    public function actives(array $columns = ['*'])
    {
        return $this->model->active()->get($columns);
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
     * Fail a project
     *
     * @param int $project_id
     * @return bool
     */
    public function fail($project_id)
    {
        return $this->model($project_id)->setAttribute('active', false)->save();
    }

    /**
     * Returns all failed Projects
     *
     * @return ProjectRepository
     */
    public function failed()
    {
        return $this->model->failed()->get();
    }

    /**
     * Returns all submissions for this project stage
     *
     * @param Model $model
     * @param $user_id
     * @param array $fields
     * @return Collection
     * @internal param Model $stage
     * @internal param Model $model
     */
    public function submit(Model $model, $user_id, array $fields)
    {
        return app()->make($model->repository)->submit($model->id, $user_id, $fields);
    }

    /**
     * Returns all submissions for this project stage
     *
     * @param int $project_id
     * @param bool $public Returns Public Submissions
     * @param bool $force Force return all submissions
     * @return Collection
     */
    public function submissions($project_id, $public = true, $force = false)
    {

        $submissions = $this->model($project_id)->stage->submissions();

        if ($force) return $submissions->get();

        if ($public) return $submissions->public()->get();

        return $submissions->private()->get();

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