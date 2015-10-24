<?php

namespace DreamsArk\Commands\Project\Vote;

use DreamsArk\Commands\Bag\RefundUserCommand;
use DreamsArk\Commands\Command;
use DreamsArk\Commands\Project\FailProjectCommand;
use DreamsArk\Commands\Project\Idea\CreateIdeaWinnerCommand;
use DreamsArk\Commands\Project\Submission\CreateSubmissionWinnerCommand;
use DreamsArk\Events\Project\Vote\VoteHasFailed;
use DreamsArk\Events\Project\Vote\VoteHasFinished;
use DreamsArk\Models\Project\Vote;
use DreamsArk\Models\Project\Submission;
use DreamsArk\Repositories\Project\Vote\VoteRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class CloseVotingCommand extends Command implements SelfHandling
{
    use SerializesModels, DispatchesJobs;

    /**
     * @var Vote
     */
    private $vote;

    /**
     * Create a new command instance.
     *
     * @param Vote $vote
     */
    public function __construct(Vote $vote)
    {
        $this->vote = $vote;
    }

    /**
     * Execute the command.
     *
     * @param Submission $submission
     * @param VoteRepositoryInterface $repository
     * @param Dispatcher $event
     */
    public function handle(Submission $submission, VoteRepositoryInterface $repository, Dispatcher $event)
    {

        /**
         * Get which Submission had more Votes
         * @todo Improve this messy function
         */
        /** @var Collection $submissions */
        $submissions = $this->vote->votable->submissions->load('votes');
        $votes = $submissions->pluck('votes', 'id')->map(function ($item) {
            return $item->sum('pivot.amount');
        });

        /**
         * if don't have any votes there will be no winner, so declare this failed
         */
        if ($votes->sum() <= 0) {

            /**
             * Fail The project stage
             */
            $this->dispatch(new FailProjectCommand($this->vote->votable->project));

            /**
             * Announce Vote has Failed
             */
            $event->fire(new VoteHasFailed($this->vote));

            return;
        }

        /**
         * Retrieve Winner Submission
         */
        $submission_winner = $submission->findOrFail($votes->sort()->keys()->pop());

        /**
         * Register Winner
         */
        $this->dispatch(new CreateSubmissionWinnerCommand($submission_winner));

        /**
         * Refund Losers
         */
        $losers = $submissions->filter(function ($submission) use ($submission_winner) {
            return $submission->id != $submission_winner->id;
        });

        $losers->pluck('votes', 'id')->map(function ($item) {
            $item->map(function ($user) {
                $command = $command = new RefundUserCommand($user->pivot->amount, $user);
                $this->dispatch($command);
            });
        });

        /**
         * Announce VoteHasFinished
         */
        $event->fire(new VoteHasFinished($this->vote));

    }
}
