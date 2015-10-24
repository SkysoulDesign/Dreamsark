<?php

namespace DreamsArk\Commands\Project\Synapse;

use Carbon\Carbon;
use DreamsArk\Commands\Command;
use DreamsArk\Commands\Project\ChargeUserCommand;
use DreamsArk\Commands\Project\Vote\CreateVotingCommand;
use DreamsArk\Events\Project\Synapse\SynapseWasCreated;
use DreamsArk\Models\Project\Synapse\Synapse;
use DreamsArk\Repositories\Project\Synapse\SynapseRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Bus\DispatchesJobs;

class CreateSynapseCommand extends Command implements SelfHandling
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
     * @param SynapseRepositoryInterface $repository
     * @param Dispatcher $event
     * @param Carbon $carbon
     * @return Synapse
     */
    public function handle(SynapseRepositoryInterface $repository, Dispatcher $event, Carbon $carbon)
    {
        /**
         * Create Idea
         */
        $synapse = $repository->create($this->project_id, $this->fields->all());

        /**
         * Deduct Coins from the user
         */
        $command = new ChargeUserCommand($synapse->project->user, $this->fields->get('reward'));
        $this->dispatch($command);

        /**
         * Create Voting
         */
        /** @var Carbon $vote_open_date */
        $vote_open_date = $carbon->parse($this->fields->get('vote_date'));
        $vote_close_date = $vote_open_date->copy()->addMinutes(5);

        $this->dispatch(new CreateVotingCommand($synapse, $vote_open_date, $vote_close_date));

        /**
         * Announce IdeaWasCreated
         */
        $event->fire(new SynapseWasCreated($synapse));

    }
}
