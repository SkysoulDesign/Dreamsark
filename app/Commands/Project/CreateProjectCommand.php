<?php

namespace DreamsArk\Commands\Project;

use DreamsArk\Commands\Command;
use DreamsArk\Events\Project\ProjectWasCreated;
use DreamsArk\Models\Project;
use DreamsArk\Repositories\Project\ProjectRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class CreateProjectCommand extends Command implements SelfHandling
{
    /**
     * @var array
     */
    private $fields;
    /**
     * @var
     */
    private $user_id;

    /**
     * Create a new command instance.
     *
     * @param array $fields
     * @param int $user_id
     */
    public function __construct(array $fields, $user_id)
    {
        $this->fields = $fields;
        $this->user_id = $user_id;
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
        $project = $repository->attach($this->fields, $this->user_id);

        /**
         * Announce ProjectWasCreated
         */
        $event->fire(new ProjectWasCreated($project));

        return $project;

    }
}
