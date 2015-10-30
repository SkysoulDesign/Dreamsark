<?php

namespace DreamsArk\Commands\Project\Script;

use Carbon\Carbon;
use DreamsArk\Commands\Command;
use DreamsArk\Commands\Project\ChargeUserCommand;
use DreamsArk\Commands\Project\Vote\CreateVotingCommand;
use DreamsArk\Events\Project\Script\ScriptWasCreated;
use DreamsArk\Models\Project\Stages\Script;
use DreamsArk\Repositories\Project\Script\ScriptRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Bus\DispatchesJobs;

class CreateScriptCommand extends Command implements SelfHandling
{
    use DispatchesJobs;

    /**
     * @var int
     */
    private $project_id;

    /**
     * @var array
     */
    private $fields;

    /**
     * Create a new command instance.
     *
     * @param int $project_id
     * @param array $fields
     */
    public function __construct($project_id, array $fields)
    {
        $this->project_id = $project_id;
        $this->fields = collect($fields);
    }

    /**
     * Execute the command.
     *
     * @param ScriptRepositoryInterface $repository
     * @param Dispatcher $event
     * @param Carbon $carbon
     * @return \DreamsArk\Models\Project\Stages\Script
     */
    public function handle(ScriptRepositoryInterface $repository, Dispatcher $event, Carbon $carbon)
    {
        /**
         * Create Idea
         */
        $script = $repository->create($this->project_id, $this->fields->all());

        /**
         * Announce IdeaWasCreated
         */
        $event->fire(new ScriptWasCreated($script));

    }
}
