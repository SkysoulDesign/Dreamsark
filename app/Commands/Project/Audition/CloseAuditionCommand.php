<?php

namespace DreamsArk\Commands\Project\Audition;

use DreamsArk\Commands\Command;
use DreamsArk\Events\Project\Audition\AuditionHasFinished;
use DreamsArk\Models\Project\Audition;
use DreamsArk\Models\Project\Idea\Submission;
use DreamsArk\Repositories\Project\Audition\AuditionRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Queue\SerializesModels;

class CloseAuditionCommand extends Command implements SelfHandling
{
    use SerializesModels;

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
//        $submissions = $this->audition->project->submissions->load('votes');
//        $votes = $submissions->pluck('votes', 'id')->map(function ($item) {
//            return $item->count();
//        });

        /**
         * Retrieve Winner Submission
         */
//        $submission_winner = $submission->findOrFail($votes->sort()->keys()->pop());

        /**
         * Remove Audition
         */
//        $repository->delete($this->audition->id);

        /**
         * Announce AuditionHasFinished
         */
//        $event->fire(new AuditionHasFinished());

    }
}
