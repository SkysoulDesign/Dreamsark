<?php

namespace DreamsArk\Commands\Project;

use DreamsArk\Commands\Command;
use DreamsArk\Commands\Bag\RefundUserCommand;
use DreamsArk\Events\Project\ProjectHasFailed;
use DreamsArk\Models\Project\Project;
use DreamsArk\Repositories\Project\ProjectRepository;
use DreamsArk\Repositories\Project\ProjectRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\DispatchesJobs;

class FailProjectCommand extends Command implements SelfHandling
{

    use DispatchesJobs;

    /**
     * @var Project
     */
    private $project;

    /**
     * Create a new command instance.
     *
     * @param Project $project
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
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
         * If it`s not a Project Instance then initialize its repository and fail it
         */
        $repository->fail($this->project->id);
        app()->make($this->project->stage->repository)->fail($this->project->stage->id);

        /**
         * Set Reward
         */
        $reward = $this->project->stage->reward;

        /**
         * Refund Project Owner
         */
        $this->dispatch(new RefundUserCommand($reward, $this->project->user));

        /**
         * Announce ProjectHasFailed
         */
        $event->fire(new ProjectHasFailed($this->project));

    }
}
