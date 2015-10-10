<?php

namespace DreamsArk\Commands\Project;

use DreamsArk\Commands\Command;
use DreamsArk\Events\Project\ProjectWasPledged;
use DreamsArk\Repositories\Project\ProjectRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class PleadgeProjectCommand extends Command implements SelfHandling
{
    /**
     * @var
     */
    private $amount;

    /**
     * @var
     */
    private $project_id;

    /**
     * @var
     */
    private $user_id;

    /**
     * Create a new command instance.
     *
     * @param $project_id
     * @param $user_id
     * @param $amount
     */
    public function __construct($project_id, $user_id, $amount)
    {
        $this->amount = $amount;
        $this->project_id = $project_id;
        $this->user_id = $user_id;
    }

    /**
     * Execute the command.
     *
     * @param ProjectRepositoryInterface $repository
     * @param Dispatcher $event
     */
    public function handle(ProjectRepositoryInterface $repository, Dispatcher $event)
    {
        /**
         * Please Project
         */
        $repository->pledge($this->project_id, $this->user_id, $this->amount);

        /**
         * Announce ProjectWasCreated
         */
        $event->fire(new ProjectWasPledged($this->project_id, $this->user_id));

    }
}
