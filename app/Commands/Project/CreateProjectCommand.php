<?php

namespace DreamsArk\Commands\Project;

use Carbon\Carbon;
use DreamsArk\Commands\Command;
use DreamsArk\Commands\Project\Vote\CreateVotingCommand;
use DreamsArk\Commands\Project\Idea\CreateIdeaCommand;
use DreamsArk\Commands\Project\Script\CreateScriptCommand;
use DreamsArk\Commands\Project\Synapse\CreateSynapseCommand;
use DreamsArk\Events\Project\ProjectWasCreated;
use DreamsArk\Models\Project\Project;
use DreamsArk\Models\User\User;
use DreamsArk\Repositories\Project\ProjectRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Bus\DispatchesJobs;


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
     * @var Project
     */
    private $project;

    /**
     * Create a new command instance.
     *
     * @param User $user
     * @param array $fields
     * @param Project $project
     */
    public function __construct(User $user, array $fields, Project $project = null)
    {
        $this->fields = collect($fields);
        $this->user = $user;
        $this->project = $project;
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

        $type = $this->fields->get('type', $this->project ? $this->project->nextStageName() : 'idea');

        /**
         * Create Project if not already created
         */
        $project = $this->project ?: $repository->create($this->user->id, $type, $this->fields->toArray());

        /**
         * @todo the update command is generating a new instance and the old type is being sent down the line
         *       maybe if some function use $project->stage will get wrong stage
         * If project exists then update it to the next stage
         */
        if ($this->project) {
            $this->dispatch(new UpdateProjectStageCommand($this->project, $this->project->nextStageName()));
        }

        /**
         * Create Project Idea
         */
        if ($type == 'idea') {
            $this->dispatch(new CreateIdeaCommand($project->id, $this->fields->toArray()));
        }

        /**
         * Create Project Synapse
         */
        if ($type == 'synapse') {
            $this->dispatch(new CreateSynapseCommand($project->id, $this->fields->toArray()));
        }

        /**
         * Create Project Script
         */
        if ($type == 'script') {
            $this->dispatch(new CreateScriptCommand($project->id, $this->fields->toArray()));
        }

        /**
         * Announce ProjectWasCreated
         */
        $event->fire(new ProjectWasCreated($project));

        return $project;
    }
}
