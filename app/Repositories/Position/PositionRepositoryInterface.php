<?php

namespace DreamsArk\Repositories\Position;

interface PositionRepositoryInterface
{

    /**
     * Get all Model from the DB
     *
     * @param array $columns
     * @return mixed
     */
    public function all(array $columns = ['*']);

}