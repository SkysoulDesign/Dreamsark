<?php

namespace DreamsArk\Repositories\Project\Idea;

use DreamsArk\Models\Idea\Idea;
use DreamsArk\Models\Idea\Submission;
use DreamsArk\Models\User\User;
use DreamsArk\Repositories\RepositoryHelperTrait;
use Illuminate\Support\Collection;

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
     * Submit new suggestion to an Idea
     *
     * @param int $idea_id
     * @param int $user_id
     * @param array $fields
     * @return Submission
     */
    public function submitIdea($idea_id, $user_id, array $fields)
    {
        $submission = $this->submission
            ->setAttribute('idea_id', $idea_id)
            ->setAttribute('user_id', $user_id)
            ->fill($fields);
        $submission->save();
        return $submission;
    }

    /**
     * Bid a user to an Idea
     *
     * @param int $user_id
     * @param int $idea_id
     * @return null
     */
    public function bid($user_id, $idea_id)
    {
        return $this->model($idea_id)->bidders()->attach(compact('user_id'));
    }

    /**
     * Return all Ideas which the given user has Bid
     *
     * @param int $user_id
     * @return Collection of Idea
     */
    public function bids($user_id)
    {
        return User::findOrFail($user_id)->bids;
    }

}