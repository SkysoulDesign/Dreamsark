<?php

namespace DreamsArk\Commands\User\Project;

use DreamsArk\Commands\Command;
use DreamsArk\Events\User\Project\ProjectDraftWasCreated;
use DreamsArk\Models\User\User;
use DreamsArk\Repositories\Project\ProjectRepositoryInterface;
use DreamsArk\Repositories\User\UserRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class CreateProjectDraftCommand extends Command implements SelfHandling
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
        $this->fields = $fields;
        $this->user = $user;
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
         * Create Project Draft
         */
        $draft = $repository->draft()->create($this->user->id, $this->fields['type'], $this->fields);

        /**
         * Announce ProjectDraftWasCreated
         */
        $event->fire(new ProjectDraftWasCreated($draft));

    }
}
