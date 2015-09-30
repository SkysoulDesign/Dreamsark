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
     * Update Settings
     *
     * @param Int $model_id
     * @param array $fields
     * @return bool
     */
    public function update($model_id, array $fields)
    {
        return $this->model($model_id)->update($fields);
    }

    /**
     * Set this model instance by a given id
     *
     * @param $model_id
     * @return Model
     */
    public function model($model_id)
    {
        return $this->model->findOrFail($model_id);
    }

}