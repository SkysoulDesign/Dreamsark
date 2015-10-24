<?php

namespace DreamsArk\Commands\Project\Idea;

use Carbon\Carbon;
use DreamsArk\Commands\Command;
use DreamsArk\Commands\Project\ChargeUserCommand;
use DreamsArk\Commands\Project\Vote\CreateVotingCommand;
use DreamsArk\Events\Project\IdeaWasCreated;
use DreamsArk\Models\Project\Idea\Idea;
use DreamsArk\Repositories\Project\Idea\IdeaRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Bus\DispatchesJobs;

class CreateIdeaCommand extends Command implements SelfHandling
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
     * @param IdeaRepositoryInterface $repository
     * @param Dispatcher $event
     * @param Carbon $carbon
     * @return Idea
     */
    public function handle(IdeaRepositoryInterface $repository, Dispatcher $event, Carbon $carbon)
    {
        /**
         * Create Idea
         */
        $idea = $repository->create($this->project_id, $this->fields->all());

        /**
         * Deduct Coins from the user
         */
        $command = new ChargeUserCommand($idea->project->user, $this->fields->get('reward'));
        $this->dispatch($command);

        /**
         * Create Voting
         */
        /** @var Carbon $vote_open_date */
        $vote_open_date = $carbon->parse($this->fields->get('vote_date'));
        $vote_close_date = $vote_open_date->copy()->addMinutes(5);

        $this->dispatch(new CreateVotingCommand($idea, $vote_open_date, $vote_close_date));

        /**
         * Announce IdeaWasCreated
         */
        $event->fire(new IdeaWasCreated($idea));

    }
}
