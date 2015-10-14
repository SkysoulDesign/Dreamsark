<?php

namespace DreamsArk\Commands\Project;

use DreamsArk\Commands\Command;
use DreamsArk\Events\Project\CastWasAdded;
use DreamsArk\Models\Project\Project;
use DreamsArk\Repositories\Project\ProjectRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class AddCastCommand extends Command implements SelfHandling
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
         * Add Cast to Project
         */
        $cast = $repository->addCast($this->project->id, $this->fields);

        /**
         * Announce CastWasAdded
         */
        $event->fire(new CastWasAdded($cast, $this->project));

    }
}
