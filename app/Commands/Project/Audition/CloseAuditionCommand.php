<?php

namespace DreamsArk\Commands\Project\Audition;

use DreamsArk\Commands\Bag\RefoundUserCommand;
use DreamsArk\Commands\Command;
use DreamsArk\Events\Project\Audition\AuditionHasFinished;
use DreamsArk\Models\Project\Audition;
use DreamsArk\Models\Project\Idea\Submission;
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
        $submissions = $this->audition->project->submissions->load('votes');
        $votes = $submissions->pluck('votes', 'id')->map(function ($item) {
            return $item->sum('pivot.amount');
        });

        /**
         * Retrieve Winner Submission
         */
        $submission_winner = $submission->findOrFail($votes->sort()->keys()->pop());

        /**
         * Refund Users
         */
        $losers = $submissions->filter(function ($submission) use ($submission_winner) {
            return $submission->id != $submission_winner->id;
        });

        $losers->pluck('votes', 'id')->map(function ($item) {
            $item->map(function ($user) {
                $command = $command = new RefoundUserCommand($user->pivot->amount, $user);
                $this->dispatch($command);
            });
        });

        /**
         * Remove Audition
         */
        $repository->delete($this->audition->id);

        /**
         * Announce AuditionHasFinished
         */
        $event->fire(new AuditionHasFinished());

    }
}
