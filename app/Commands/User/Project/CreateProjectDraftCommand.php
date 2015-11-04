<?php

namespace DreamsArk\Commands\User\Project;

use DreamsArk\Commands\Command;
use DreamsArk\Events\User\Project\ProjectDraftWasCreated;
use DreamsArk\Models\User\User;
use DreamsArk\Repositories\Project\Draft\DraftRepositoryInterface;
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
        $this->user = $user;
        $this->fields = collect($fields);
    }

    /**
     * Execute the command.
     *
     * @param DraftRepositoryInterface $repository
     * @param Dispatcher $event
     */
    public function handle(DraftRepositoryInterface $repository, Dispatcher $event)
    {
        /**
         * Create Project Draft
         */
        $draft = $repository->create($this->user->id, $this->fields->get('type'), $this->fields->toArray());

        /**
         * Announce ProjectDraftWasCreated
         */
        $event->fire(new ProjectDraftWasCreated($draft));

    }
}
