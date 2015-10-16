<?php

namespace DreamsArk\Repositories\Project\Submission;


use DreamsArk\Models\Project\Idea\Submission;
use DreamsArk\Repositories\RepositoryHelperTrait;

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
     * Vote on a Submission
     *
     * @param int $submission_id
     * @param int $user_id
     */
    public function vote($submission_id, $user_id)
    {
        $this->model($submission_id)->votes()->attach($user_id);
    }
}