<?php

namespace DreamsArk\Listeners\Project\Vote;

use DreamsArk\Commands\Project\StartProjectCommand;
use DreamsArk\Events\Project\Vote\VotingHasFinished;
use Illuminate\Foundation\Bus\DispatchesJobs;

class CheckIfIsTheLastStage
{

    use DispatchesJobs;

    /**
     * Handle the event.
     *
     * @param  VotingHasFinished $event
     * @return void
     */
    public function handle(VotingHasFinished $event)
    {

        if ($event->vote->votable->isLastStage()) {
            $this->dispatch(new StartProjectCommand($event->vote->project));
        }
    }
}
