<?php

namespace DreamsArk\Repositories\Project\Script;

use DreamsArk\Models\Project\Submission;
use DreamsArk\Models\Project\Script\Script;
use DreamsArk\Repositories\RepositoryHelperTrait;

class ScriptRepository implements ScriptRepositoryInterface
{

    use RepositoryHelperTrait;

    /**
     * @var Script
     */
    public $model;

    /**
     * @var Submission
     */
    private $submission;

    /**
     * @param Script $script
     * @param Submission $submission
     */
    function __construct(Script $script, Submission $submission)
    {
        $this->model = $script;
        $this->submission = $submission;
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
     * Create a Script
     *
     * @param int $project_id
     * @param array $fields
     * @return Script
     */
    public function create($project_id, array $fields)
    {
        $script = $this->model->setAttribute('project_id', $project_id)->fill($fields);
        $script->save();
        return $script;
    }

    /**
     * Submit Script
     *
     * @param int $script_id
     * @param int $user_id
     * @param array $fields
     * @return Submission
     */
    public function submit($script_id, $user_id, array $fields)
    {
        $submission = $this->submission->setRawAttributes(compact('script_id', 'user_id'))->fill($fields);
        $submission->save();
        return $submission;
    }

    /**
     * Vote on a Submission
     *
     * @param int $submission_id
     * @param int $user_id
     */
    public function vote($submission_id, $user_id)
    {
        $this->submission->find($submission_id)->attach($user_id);
    }

    /**
     * Fail an Script
     *
     * @param int $script_id
     * @return bool
     */
    public function fail($script_id)
    {
        return $this->model($script_id)->setAttribute('active', false)->save();
    }

    /**
     * Submit Script
     *
     * @param int $script_id
     * @param int $submission_id
     */
    public function createWinner($script_id, $submission_id)
    {
        return $this->model($script_id)->winners()->attach($submission_id);
    }

}