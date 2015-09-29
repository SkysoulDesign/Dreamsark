<?php

namespace DreamsArk\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class Repository
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * Get all Model from the DB
     *
     * @return mixed
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Delete this model
     *
     * @param $model | string $id
     * @return bool
     */
    public function delete($model)
    {
        if ($model instanceof Model) {
            return $model->delete();
        }

        return $this->model->find($model)->delete();
    }

    /**
     * Update this model
     *
     * @param Model $model
     * @param array $fields
     * @return bool
     */
    public function update(Model $model, array $fields)
    {
        return $model->update($fields);
    }

}