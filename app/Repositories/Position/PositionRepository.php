<?php

namespace DreamsArk\Repositories\Position;

use DreamsArk\Models\Project\Position;
use DreamsArk\Repositories\Repository;

class PositionRepository extends Repository implements PositionRepositoryInterface
{

    /**
     * @var Position
     */
    public $model;

    /**
     * @param Position $position
     */
    function __construct(Position $position)
    {
        $this->model = $position;
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

}