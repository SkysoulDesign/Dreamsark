<?php

namespace DreamsArk\Commands\Project\Script;

use Carbon\Carbon;
use DreamsArk\Commands\Command;
use DreamsArk\Commands\Project\ChargeUserCommand;
use DreamsArk\Commands\Project\Vote\CreateVotingCommand;
use DreamsArk\Events\Project\Script\ScriptWasCreated;
use DreamsArk\Models\Project\Script\Script;
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
     * @return Script
     */
    public function handle(ScriptRepositoryInterface $repository, Dispatcher $event, Carbon $carbon)
    {
        /**
         * Create Idea
         */
        $script = $repository->create($this->project_id, $this->fields->all());

        /**
         * Deduct Coins from the user
         */
        $command = new ChargeUserCommand($script->project->user, $this->fields->get('reward'));
        $this->dispatch($command);

        /**
         * Create Voting
         */
        /** @var Carbon $vote_open_date */
        $vote_open_date = $carbon->parse($this->fields->get('vote_date'));
        $vote_close_date = $vote_open_date->copy()->addMinutes(5);

        $this->dispatch(new CreateVotingCommand($script, $vote_open_date, $vote_close_date));

        /**
         * Announce IdeaWasCreated
         */
        $event->fire(new ScriptWasCreated($script));

    }
}
