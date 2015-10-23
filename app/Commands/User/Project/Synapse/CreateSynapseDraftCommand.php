<?php

namespace DreamsArk\Commands\User\Project\Synapse;

use DreamsArk\Commands\Command;
use DreamsArk\Events\User\Project\Synapse\SynapseDraftWasCreated;
use DreamsArk\Models\User\User;
use DreamsArk\Repositories\Project\Synapse\SynapseRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class CreateSynapseDraftCommand extends Command implements SelfHandling
{
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
     * @param User $user
     * @param array $fields
     */
    public function __construct(User $user, array $fields)
    {
        $this->user = $user;
        $this->fields = $fields;
    }

    /**
     * Execute the command.
     *
     * @param SynapseRepositoryInterface $repository
     * @param Dispatcher $event
     */
    public function handle(SynapseRepositoryInterface $repository, Dispatcher $event)
    {
        /**
         * Create Project Draft
         */
        $draft = $repository->draft()->create($this->user->id, $this->fields);

        /**
         * Announce ProjectDraftWasCreated
         */
        $event->fire(new SynapseDraftWasCreated($draft));

    }
}
