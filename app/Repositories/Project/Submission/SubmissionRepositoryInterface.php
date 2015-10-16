<?php

namespace DreamsArk\Repositories\Project\Submission;

interface SubmissionRepositoryInterface
{

    /**
     * Create a Submission
     *
     * @param int $submission_id
     * @param int $user_id
     */
    public function vote($submission_id, $user_id);

}