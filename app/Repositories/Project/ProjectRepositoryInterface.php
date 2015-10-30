<?php

namespace DreamsArk\Repositories\Project;

use DreamsArk\Models\Project\Stages\Draft;
use DreamsArk\Models\Project\Project;
use Illuminate\Support\Collection;

interface ProjectRepositoryInterface
{

    /**
     * Get all Model from the DB
     *
     * @param array $columns
     * @return mixed
     */
    public function all(array $columns = ['*']);

    /**
     * Create a Project
     *
     * @param int $user_id
     * @param string $type
     * @param array $fields
     * @return Project|\DreamsArk\Models\Project\Stages\Draft
     */
    public function create($user_id, $type, array $fields);

    /**
     * Get all Published projects by User
     *
     * @param int $user_id
     * @return Collection
     */
    public function publishedBy($user_id);

    /**
     * Set Model to Draft
     *
     * @param null $user_id
     * @return ProjectRepository
     */
    public function draft($user_id = null);

    /**
     * Delete Model
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete();

    /**
     * Returns This Model
     *
     * @return Project
     */
    public function get();

}