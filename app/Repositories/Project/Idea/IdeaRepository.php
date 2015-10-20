<?php

namespace DreamsArk\Repositories\Project\Idea;

use DreamsArk\Models\Project\Idea\Idea;
use DreamsArk\Models\Project\Idea\Submission;
use DreamsArk\Repositories\RepositoryHelperTrait;

class IdeaRepository implements IdeaRepositoryInterface
{

    use RepositoryHelperTrait;

    /**
     * @var Idea
     */
    public $model;

    /**
     * @var Submission
     */
    private $submission;

    /**
     * @param Idea $idea
     * @param Submission $submission
     */
    function __construct(Idea $idea, Submission $submission)
    {
        $this->model = $idea;
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
     * Create a Idea
     *
     * @param int $project_id
     * @param array $fields
     * @return Idea
     */
    public function create($project_id, array $fields)
    {
        $idea = $this->model->setAttribute('project_id', $project_id)->fill($fields);
        $idea->save();
        return $idea;
    }

    /**
     * Submit Idea
     *
     * @param int $idea_id
     * @param int $user_id
     * @param array $fields
     * @return Submission
     */
    public function submit($idea_id, $user_id, array $fields)
    {
        $submission = $this->submission->setRawAttributes(compact('idea_id', 'user_id'))->fill($fields);
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
     * Fail an Idea
     *
     * @param int $idea_id
     * @return bool
     */
    public function fail($idea_id)
    {
        return $this->model($idea_id)->setAttribute('active', false)->save();
    }

    /**
     * Submit Idea
     *
     * @param int $idea_id
     * @param int $submission_id
     */
    public function createWinner($idea_id, $submission_id)
    {
        return $this->model($idea_id)->winners()->attach($submission_id);
    }

}