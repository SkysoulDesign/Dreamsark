<?php

namespace DreamsArk\Commands\Project\Idea;

use DreamsArk\Commands\Command;
use DreamsArk\Commands\Project\ChargeUserCommand;
use DreamsArk\Events\Project\IdeaWasCreated;
use DreamsArk\Models\Idea\Idea;
use DreamsArk\Models\User\User;
use DreamsArk\Repositories\Project\Idea\IdeaRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Bus\DispatchesJobs;

class CreateIdeaCommand extends Command implements SelfHandling
{

    use DispatchesJobs;

    /**
     * @var array
     */
    private $fields;

    /**
     * @var int
     */
    private $project_id;

    /**
     * Create a new command instance.
     *
     * @param int $project_id
     * @param array $fields
     */
    public function __construct($project_id, array $fields)
    {
        $this->fields = $fields;
        $this->project_id = $project_id;
    }

    /**
     * Execute the command.
     *
     * @param IdeaRepositoryInterface $repository
     * @param Dispatcher $event
     * @return Idea
     */
    public function handle(IdeaRepositoryInterface $repository, Dispatcher $event)
    {
        /**
         * Create Idea
         */
        $idea = $repository->create($this->project_id, $this->fields);

        /**
         * Deduct Coins from the user
         */
        $command = new ChargeUserCommand($idea->project->user, $this->fields['reward']);
        $this->dispatch($command);

        /**
         * Announce IdeaWasCreated
         */
        $event->fire(new IdeaWasCreated($idea));

    }
}
