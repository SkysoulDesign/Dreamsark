<?php

namespace DreamsArk\Repositories;


use DreamsArk\Repositories\Project\ProjectRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait RepositoryHelperTrait
{

    /**
     * Set this model instance by a given id
     *
     * @param $model_id
     * @return Model
     */
    public function model($model_id)
    {

        /**
         * If it's already an model then set it
         */
        if ($model_id instanceof Model) {
            return $this->model = $model_id;
        }

        return $this->model->findOrFail($model_id);
    }

    /**
     * Return a new instance with the specified model as base
     *
     * @param Model|int $model
     * @param string $baseClass
     * @return $this
     */
    public function newInstance($model = null, $baseClass = null)
    {
        $instance = app()->make(get_class($this) . 'Interface');

        /**
         * if it's an ID then find it
         */
        if (is_numeric($model) && ($baseClass === null xor !class_exists($baseClass))) {
            $instance->model = $instance->model->findOrFail($model);
        }

        /**
         * If Model is a Model then set this model
         */
        if ($model instanceof Model) {

            $instance->model = $model;
        }

        /**
         * if an id is sent though $model then set to the $baseclass
         */
        if (is_numeric($model) && class_exists($baseClass)) {

            $instance->model = app($baseClass)->findOrFail(($model instanceof Model) ? $model->id : $model)->first();
        }

        /**
         * If the base class is set and no model is set
         */
        if ($model === null && class_exists($baseClass)) {
            $instance->model = app($baseClass);
        }

        return $instance;

    }

}