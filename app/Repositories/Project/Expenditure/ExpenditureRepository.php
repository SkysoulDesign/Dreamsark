<?php

namespace DreamsArk\Repositories\Project\Expenditure;

use DreamsArk\Models\Project\Expenditures\Expenditure;
use DreamsArk\Models\Project\Expenditures\Position;
use DreamsArk\Models\Project\Expenditures\Type;
use DreamsArk\Repositories\RepositoryHelperTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ExpenditureRepository implements ExpenditureRepositoryInterface
{

    use RepositoryHelperTrait;

    /**
     * @var Expenditure $expenditure
     */
    public $model;

    /**
     * @param Expenditure $expenditure
     */
    function __construct(Expenditure $expenditure)
    {
        $this->model = $expenditure;
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
     * Create new Type
     * @param string $name
     * @param int $type_id
     * @return Expenditure
     * @throws \DreamsArk\Repositories\Exceptions\RepositoryException
     */
    public function create($name, $type_id)
    {
        return $this->newInstance($type_id, Type::class)->model->position()->create(compact('name'));
    }

    /**
     * Create new Type
     * @param $name
     * @return Type
     * @throws \DreamsArk\Repositories\Exceptions\RepositoryException
     */
    public function createType($name)
    {
        return $this->newInstance(Type::class)->model->create(compact('name'));
    }

    /**
     * Get All Positions
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     * @throws \DreamsArk\Repositories\Exceptions\RepositoryException
     */
    public function positions()
    {
        return $this->newInstance(Position::class)->model->all()->load('type');
    }

    /**
     * Back a Expenditure
     *
     * @param int $expenditure_id
     * @param int $user_id
     * @param int $amount
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     * @throws \DreamsArk\Repositories\Exceptions\RepositoryException
     */
    public function back($expenditure_id, $user_id, $amount)
    {
        return $this->model($expenditure_id)->backers()->attach($user_id, compact('amount'));
    }

    /**
     * Enroll into a Expenditure
     *
     * @param int $expenditure_id
     * @param int $user_id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     * @throws \DreamsArk\Repositories\Exceptions\RepositoryException
     */
    public function enroll($expenditure_id, $user_id)
    {
        return $this->model($expenditure_id)->enrollers()->attach(array($user_id));
    }

    /**
     * Unroll from a Expenditure
     *
     * @param int $expenditure_id\
     * @param int $user_id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     * @throws \DreamsArk\Repositories\Exceptions\RepositoryException
     */
    public function unroll($expenditure_id, $user_id)
    {
        return $this->model($expenditure_id)->enrollers()->detach($user_id);
    }


}