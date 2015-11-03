<?php

namespace DreamsArk\Repositories\Project\Fund;

use DreamsArk\Models\Project\Project;
use DreamsArk\Models\Project\Stages\Fund;
use DreamsArk\Repositories\Traits\RepositoryHelperTrait;
use DreamsArk\Repositories\Traits\FallibleTrait;

class FundRepository implements FundRepositoryInterface
{

    use \DreamsArk\Repositories\Traits\RepositoryHelperTrait, FallibleTrait;

    /**
     * @var Fund
     */
    public $model;

    /**
     * @param Fund $fund
     */
    function __construct(Fund $fund)
    {
        $this->model = $fund;
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
     * Create a Fund
     *
     * @param int $project_id
     * @return Fund
     */
    public function create($project_id)
    {
        return $this->newInstance($project_id, Project::class)->model->fund()->create([]);
    }

}