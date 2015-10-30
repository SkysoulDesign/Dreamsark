<?php

namespace DreamsArk\Repositories\Project\Review;

use DreamsArk\Models\Project\Cast;
use DreamsArk\Models\Project\Expenditure;
use DreamsArk\Models\Project\Stages\Review;
use DreamsArk\Repositories\RepositoryHelperTrait;
use Illuminate\Database\Eloquent\Model;

class ReviewRepository implements ReviewRepositoryInterface
{

    use RepositoryHelperTrait;

    /**
     * @var Review
     */
    public $model;

    /**
     * @param Review $review
     */
    function __construct(Review $review)
    {
        $this->model = $review;
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
     * Create a Review
     *
     * @param int $project_id
     * @return Review
     */
    public function create($project_id)
    {
        $review = $this->model->setAttribute('project_id', $project_id);
        $review->save();
        return $review;
    }

    /**
     * Create a Review
     *
     * @param int $project_id
     * @param $position_id
     * @param array $fields
     * @return Expenditure
     * @throws \DreamsArk\Repositories\Exceptions\RepositoryException
     */
    public function createCast($project_id, $position_id, array $fields)
    {
        $cast = $this->newInstance(Cast::class)->model->setAttribute('position_id', $position_id)->fill($fields);
        $cast->save();
        return $this->createExpenditure($cast, $project_id);
    }

    /**
     * Create a Review
     *
     * @param Model $model
     * @param int $project_id
     * @return Expenditure
     */
    public function createExpenditure(Model $model, $project_id)
    {
        return $model->expenditure()->create(compact('project_id'));
    }

}