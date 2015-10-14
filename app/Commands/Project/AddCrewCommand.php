<?php

namespace DreamsArk\Commands\Project;

use DreamsArk\Commands\Command;
use DreamsArk\Events\Project\CrewWasAdded;
use DreamsArk\Models\Project\Project;
use DreamsArk\Repositories\Project\ProjectRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class AddCrewCommand extends Command implements SelfHandling
{
    /**
     * @var array
     */
    private $fields;

    /**
     * @var Project
     */
    private $project;

    /**
     * Create a new command instance.
     *
     * @param $project
     * @param array $fields
     */
    public function __construct(Project $project, array $fields)
    {
        $this->fields = $fields;
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
         * Add Crew to Project
         */
        $crew = $repository->addCrew($this->project->id, $this->fields);

        /**
         * Announce CrewWasAdded
         */
        $event->fire(new CrewWasAdded($crew, $this->project));

    }
}
