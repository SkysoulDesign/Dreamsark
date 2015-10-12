<?php

namespace DreamsArk\Commands\Project;

use DreamsArk\Commands\Command;
use DreamsArk\Events\Project\ScriptWasCreated;
use DreamsArk\Models\Project\Script;
use DreamsArk\Repositories\Project\ProjectRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class CreateScriptCommand extends Command implements SelfHandling
{
    /**
     * @var
     */
    private $project_id;

    /**
     * Create a new command instance.
     * @param int $project_id
     */
    public function __construct($project_id)
    {
        $this->project_id = $project_id;
    }

    /**
     * Execute the command.
     *
     * @param ProjectRepositoryInterface $repository
     * @param Dispatcher $event
     * @return Script
     */
    public function handle(ProjectRepositoryInterface $repository, Dispatcher $event)
    {
        /**
         * Create Script
         */
        $script = $repository->createScript($this->project_id);

        /**
         * Announce Script was Created
         */
        $event->fire(new ScriptWasCreated($script));
    }
}
