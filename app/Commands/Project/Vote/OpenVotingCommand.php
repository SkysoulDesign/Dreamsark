<?php

namespace DreamsArk\Commands\Project\Vote;

use DreamsArk\Commands\Command;
use DreamsArk\Commands\Project\FailStageCommand;
use DreamsArk\Events\Project\Vote\VoteWasOpened;
use DreamsArk\Models\Project\Vote;
use DreamsArk\Repositories\Project\Vote\VoteRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\SerializesModels;

class OpenVotingCommand extends Command implements SelfHandling
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
     * @param VoteRepositoryInterface $repository
     * @param Dispatcher $event
     * @return array|null
     */
    public function handle(VoteRepositoryInterface $repository, Dispatcher $event)
    {

        /**
         * If there are no submission then project failed, or less than the minimum submissions
         */
        if ($this->vote->votable->submissions->count() < 5) {

            /**
             * Fail this project
             */
            $this->dispatch(new FailStageCommand($this->vote->votable));

            return;
        }

        /**
         * Open Vote by setting Status to true
         */
        $repository->open($this->vote->id);

        /**
         * Announce VoteWasOpened
         */
        $event->fire(new VoteWasOpened($this->vote));

    }

}
