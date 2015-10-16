<?php

namespace DreamsArk\Repositories\Project\Audition;


use DreamsArk\Models\Project\Audition;

interface AuditionRepositoryInterface
{

    /**
     * Get all Model from the DB
     *
     * @param array $columns
     * @return mixed
     */
    public function all(array $columns = ['*']);

    /**
     * Create a Audition
     *
     * @param int $project_id
     * @param string $audition_open_date
     * @param string $audition_close_date
     * @return Audition
     */
    public function create($project_id, $audition_open_date, $audition_close_date);

    /**
     * Delete Audition
     *
     * @param int $audition_id
     * @return bool
     */
    public function delete($audition_id);


}