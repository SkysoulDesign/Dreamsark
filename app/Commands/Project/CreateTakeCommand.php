<?php

namespace DreamsArk\Commands\Project;

use DreamsArk\Commands\Command;
use DreamsArk\Events\Project\TakeWasCreated;
use DreamsArk\Models\Project\Script;
use DreamsArk\Repositories\Project\ProjectRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class CreateTakeCommand extends Command implements SelfHandling
{
    /**
     * @var array
     */
    private $fields;

    /**
     * @var Script
     */
    private $script;

    /**
     * Create a new command instance.
     *
     * @param Script $script
     * @param array $fields
     */
    public function __construct(Script $script, array $fields)
    {
        $this->fields = $fields;
        $this->script = $script;
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
         * Create Take
         */
        $take = $repository->createTake($this->script->id, $this->fields);

        /**
         * Announce TakeWasCreated
         */
        $event->fire(new TakeWasCreated($take));

    }
}
