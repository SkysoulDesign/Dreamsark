<?php

namespace DreamsArk\Commands\Project;

use DreamsArk\Commands\Command;
use DreamsArk\Events\Project\UserHasEnrolledToCast;
use DreamsArk\Models\Project\Cast;
use DreamsArk\Models\User\User;
use DreamsArk\Repositories\Project\ProjectRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class EnrollCastCommand extends Command implements SelfHandling
{
    /**
     * @var Cast
     */
    private $cast;

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new command instance.
     *
     * @param Cast $cast
     * @param User $user
     */
    public function __construct(Cast $cast, User $user)
    {
        $this->cast = $cast;
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
         * Add User to Cast
         */
        $repository->attachCast($this->cast->id, $this->user->id);

        /**
         * Announce UserHasEnrolledToCast
         */
        $event->fire(new UserHasEnrolledToCast($this->user, $this->cast));

    }
}
