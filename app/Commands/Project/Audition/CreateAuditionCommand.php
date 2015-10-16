<?php

namespace DreamsArk\Commands\Project\Audition;

use DreamsArk\Commands\Command;
use DreamsArk\Events\Project\Audition\AuditionWasCreated;
use DreamsArk\Jobs\Project\Audition\QueueProjectAuditionJob;
use DreamsArk\Jobs\Project\Audition\SetProjectAuditionModeJob;
use DreamsArk\Models\Project\Audition;
use DreamsArk\Models\Project\Project;
use DreamsArk\Repositories\Project\Audition\AuditionRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Bus\DispatchesJobs;

class CreateAuditionCommand extends Command implements SelfHandling
{

    use DispatchesJobs;

    /**
     * @var Project
     */
    private $project;

    /**
     * @var
     */
    private $audition_open_date;

    /**
     * @var
     */
    private $audition_close_date;

    /**
     * Create a new command instance.
     * @param Project $project
     * @param $audition_open_date
     * @param $audition_close_date
     */
    public function __construct(Project $project, $audition_open_date, $audition_close_date)
    {
        $this->project = $project;
        $this->audition_open_date = $audition_open_date;
        $this->audition_close_date = $audition_close_date;
    }

    /**
     * Execute the command.
     *
     * @param AuditionRepositoryInterface $repository
     * @param Dispatcher $event
     */
    public function handle(AuditionRepositoryInterface $repository, Dispatcher $event)
    {

        /**
         * Create Audition
         */
        $audition = $repository->create($this->project->id, $this->audition_open_date, $this->audition_close_date);

        /**
         * Announce AuditionWasCreated
         */
        $event->fire(new AuditionWasCreated($audition));

    }
}
