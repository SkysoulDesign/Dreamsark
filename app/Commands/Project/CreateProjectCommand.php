<?php

namespace DreamsArk\Commands\Project;

use DreamsArk\Commands\Command;
use DreamsArk\Commands\Project\Idea\CreateIdeaCommand;
use DreamsArk\Events\Project\ProjectWasCreated;
use DreamsArk\Models\Project\Project;
use DreamsArk\Models\User\User;
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
    private $request;

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new command instance.
     *
     * @param User $user
     * @param Request $request
     */
    public function __construct(User $user, Request $request)
    {
        $this->request = $request;
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
        $project = $repository->create($this->user->id, 1);

        /**
         * Create Project Idea
         */
        $this->dispatch(new CreateIdeaCommand($project->id, $this->request->all()));

        /**
         * Announce ProjectWasCreated
         */
        $event->fire(new ProjectWasCreated($project));

    }
}
