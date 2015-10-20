<?php

namespace DreamsArk\Commands\Project\Audition;

use DreamsArk\Commands\Command;
use DreamsArk\Commands\Project\FailProjectCommand;
use DreamsArk\Events\Project\Audition\AuditionWasOpened;
use DreamsArk\Events\Project\ProjectHasFailed;
use DreamsArk\Models\Project\Audition;
use DreamsArk\Repositories\Project\Audition\AuditionRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\SerializesModels;

class OpenAuditionCommand extends Command implements SelfHandling
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
     * @param AuditionRepositoryInterface $repository
     * @param Dispatcher $event
     * @return array|null
     */
    public function handle(AuditionRepositoryInterface $repository, Dispatcher $event)
    {

        /**
         * If there are no submission then project failed, or less than the minimum submissions
         */
        if ($this->audition->project->submissions->count() < 10) {

            /**
             * Fail this project
             */
            $this->dispatch(new FailProjectCommand($this->audition->project->stage()));

            return;
        }

        /**
         * Open Audition by setting Status to true
         */
        $repository->open($this->audition->id);

        /**
         * Announce AuditionWasOpened
         */
        $event->fire(new AuditionWasOpened($this->audition));

    }

}
