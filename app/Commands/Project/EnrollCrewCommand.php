<?php

namespace DreamsArk\Commands\Project;

use DreamsArk\Commands\Command;
use DreamsArk\Events\Project\UserHasEnrolledToCrew;
use DreamsArk\Models\Project\Crew;
use DreamsArk\Models\User;
use DreamsArk\Repositories\Project\ProjectRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class EnrollCrewCommand extends Command implements SelfHandling
{
    /**
     * @var Crew
     */
    private $crew;

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new command instance.
     *
     * @param Crew $crew
     * @param User $user
     */
    public function __construct(Crew $crew, User $user)
    {
        $this->crew = $crew;
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
         * Add User to Crew
         */
        $repository->attachCrew($this->crew->id, $this->user->id);

        /**
         * Announce UserHasEnrolledToCrew
         */
        $event->fire(new UserHasEnrolledToCrew($this->user, $this->crew));

    }
}
