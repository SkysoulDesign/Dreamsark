<?php

namespace DreamsArk\Repositories\Project\Audition;

use DreamsArk\Models\Project\Audition;
use DreamsArk\Repositories\RepositoryHelperTrait;
use Illuminate\Support\Collection;

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
     * Return all open audition
     *
     * @return Collection
     */
    public function allOpened()
    {
        return $this->model->opened()->get();
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

    /**
     * Set Status to Open
     *
     * @param $audition_id
     * @return bool|int
     */
    public function open($audition_id)
    {
        return $this->model($audition_id)->setAttribute('active', true)->save();
    }

    /**
     * Set Status to Close
     *
     * @param $audition_id
     * @return bool|int
     */
    public function close($audition_id)
    {
        return $this->model($audition_id)->setAttribute('active', false)->save();
    }

    /**
     * Deactivate Audition
     *
     * @param int $audition_id
     * @return bool
     */
    public function deactivate($audition_id)
    {
        return $this->model($audition_id)->setAttribute('active', false)->save();
    }

}