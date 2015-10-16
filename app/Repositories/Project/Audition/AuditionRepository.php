<?php

namespace DreamsArk\Repositories\Project\Audition;

use DreamsArk\Models\Project\Audition;
use DreamsArk\Repositories\RepositoryHelperTrait;

class AuditionRepository implements AuditionRepositoryInterface
{

    use RepositoryHelperTrait;

    /**
     * @var Audition
     */
    public $model;

    /**
     * @param Audition $idea
     */
    function __construct(Audition $idea)
    {
        $this->model = $idea;
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
     * Create a Audition
     *
     * @param int $project_id
     * @param string $audition_open_date
     * @param string $audition_close_date
     * @return Audition
     */
    public function create($project_id, $audition_open_date, $audition_close_date)
    {
        $audition = $this->model
            ->setAttribute('project_id', $project_id)
            ->setAttribute('open_date', $audition_open_date)
            ->setAttribute('close_date', $audition_close_date);
        $audition->save();
        return $audition;
    }

    /**
     * Delete Audition
     *
     * @param int $audition_id
     * @return bool
     */
    public function delete($audition_id)
    {
        return $this->model($audition_id)->delete();
    }

}