<?php

namespace DreamsArk\Commands\Project;

use DreamsArk\Commands\Command;
use DreamsArk\Events\Project\ProjectWasCreated;
use DreamsArk\Models\Project\Project;
use DreamsArk\Models\User;
use DreamsArk\Repositories\Project\ProjectRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;


class CreateProjectCommand extends Command implements SelfHandling
{

    use DispatchesJobs;

    /**
     * @var array
     */
    private $fields;

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new command instance.
     *
     * @param Request $fields
     * @param User $user
     */
    public function __construct(Request $fields, User $user)
    {
        $this->fields = $fields;
        $this->user = $user;
    }

    /**
     * Execute the command.
     *
     * @param ProjectRepositoryInterface $repository
     * @param Dispatcher $event
     * @return Project
     */
    public function handle(ProjectRepositoryInterface $repository, Dispatcher $event)
    {
        /**
         * Create Project
         */
        $project = $repository->attach($this->fields->all(), $this->user->id);

        /**
         * Announce ProjectWasCreated
         */
        $event->fire(new ProjectWasCreated($project));

        /**
         * Self Pledge The Project
         */
        $command = new PledgeProjectCommand($project, $this->user, $this->fields->get('amount'));
        $this->dispatch($command);

        /**
         * Create the project Script
         */
        $this->dispatch(new CreateScriptCommand($project->id));

        return $project;

    }
}
