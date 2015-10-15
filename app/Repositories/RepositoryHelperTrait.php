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
        return $this->model->findOrFail($model_id);
    }

}