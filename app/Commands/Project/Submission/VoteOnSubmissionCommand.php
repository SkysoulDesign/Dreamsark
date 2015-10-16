<?php

namespace DreamsArk\Commands\Project\Submission;

use DreamsArk\Commands\Command;
use DreamsArk\Events\Project\Submission\SubmissionReceivedAVote;
use DreamsArk\Models\Project\Idea\Submission;
use DreamsArk\Models\User\User;
use DreamsArk\Repositories\Project\Submission\SubmissionRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class VoteOnSubmissionCommand extends Command implements SelfHandling
{
    /**
     * @var Submission
     */
    private $submission;

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new command instance.
     *
     * @param Submission $submission
     * @param User $user
     */
    public function __construct(Submission $submission, User $user)
    {
        $this->submission = $submission;
        $this->user = $user;
    }

    /**
     * Execute the command.
     *
     * @param SubmissionRepositoryInterface $repository
     * @param Dispatcher $event
     */
    public function handle(SubmissionRepositoryInterface $repository, Dispatcher $event)
    {
        /**
         * Vote on a Idea Submission
         */
        $repository->vote($this->submission->id, $this->user->id);

        /**
         * Announce a SubmissionReceivedAVote
         */
        $event->fire(new SubmissionReceivedAVote($this->submission, $this->user));
    }
}
