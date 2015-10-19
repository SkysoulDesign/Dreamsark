<?php

namespace DreamsArk\Repositories\Project\Submission;


use DreamsArk\Models\Project\Idea\Idea;
use DreamsArk\Models\Project\Idea\Submission;
use DreamsArk\Models\Project\Project;
use DreamsArk\Repositories\Project\Idea\IdeaRepositoryInterface;
use DreamsArk\Repositories\RepositoryHelperTrait;
use Illuminate\Support\Collection;

class SubmissionRepository implements SubmissionRepositoryInterface
{

    use RepositoryHelperTrait;

    /**
     * @var Submission
     */
    public $model;

    /**
     * @param Submission $submission
     */
    function __construct(Submission $submission)
    {
        $this->model = $submission;
    }

    /**
     * Return All Submissions for set model
     *
     * @param bool $real
     * @return $this
     */
    public function all($real = false)
    {
        return $real ? $this->model->all() : $this->model->submissions;
    }

    /**
     * Vote on a Submission
     *
     * @param int $amount
     * @param int $submission_id
     * @param int $user_id
     */
    public function vote($amount, $submission_id, $user_id)
    {
        $this->model($submission_id)->votes()->attach($user_id, compact('amount'));
    }

    /**
     * Get All Public Submissions
     *
     * @return Collection
     */
    public function allPublic()
    {
        return $this->model->submissions()->public()->get();
    }

    /**
     * Get All Private Submissions
     *
     * @return Collection
     */
    public function allPrivate()
    {
        return $this->model->submissions()->private()->get();
    }

    /**
     * Set The Idea Model
     *
     * @param Idea $idea
     * @return $this
     */
    public function idea(Idea $idea)
    {
        return $this->newInstance($idea);
    }

}