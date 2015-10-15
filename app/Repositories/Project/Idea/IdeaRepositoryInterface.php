<?php

namespace DreamsArk\Repositories\Project\Idea;

use DreamsArk\Models\Idea\Idea;
use Illuminate\Support\Collection;

interface IdeaRepositoryInterface
{

    /**
     * Get all Model from the DB
     *
     * @param array $columns
     * @return mixed
     */
    public function all(array $columns = ['*']);

    /**
     * Create a Idea
     *
     * @param int $project_id
     * @param array $fields
     * @return Idea
     */
    public function create($project_id, array $fields);

    /**
     * Return all Ideas which the given user has Bid
     *
     * @param int $user_id
     * @return Collection of Idea
     */
    public function bids($user_id);

}