<?php

namespace DreamsArk\Commands\Project\Audition;

use DreamsArk\Commands\Bag\RefundUserCommand;
use DreamsArk\Commands\Command;
use DreamsArk\Commands\Project\FailProjectCommand;
use DreamsArk\Commands\Project\Idea\CreateIdeaWinnerCommand;
use DreamsArk\Commands\Project\Submission\CreateSubmissionWinnerCommand;
use DreamsArk\Events\Project\Audition\AuditionHasFailed;
use DreamsArk\Events\Project\Audition\AuditionHasFinished;
use DreamsArk\Models\Project\Audition;
use DreamsArk\Models\Project\Submission;
use DreamsArk\Repositories\Project\Audition\AuditionRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class CloseAuditionCommand extends Command implements SelfHandling
{
    use SerializesModels, DispatchesJobs;

    /**
     * @var Audition
     */
    private $audition;

    /**
     * Create a new command instance.
     *
     * @param Audition $audition
     */
    public function __construct(Audition $audition)
    {
        $this->audition = $audition;
    }

    /**
     * Execute the command.
     *
     * @param Submission $submission
     * @param AuditionRepositoryInterface $repository
     * @param Dispatcher $event
     */
    public function handle(Submission $submission, AuditionRepositoryInterface $repository, Dispatcher $event)
    {

        /**
         * Get which Submission had more Votes
         * @todo Improve this messy function
         */
        /** @var Collection $submissions */
        $submissions = $this->audition->project->stage->submissions->load('votes');
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
            $this->dispatch(new FailProjectCommand($this->audition->project));

            /**
             * Announce Audition has Failed
             */
            $event->fire(new AuditionHasFailed($this->audition));

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
         * Announce AuditionHasFinished
         */
        $event->fire(new AuditionHasFinished($this->audition));

    }
}
