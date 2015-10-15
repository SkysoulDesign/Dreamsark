<?php

namespace DreamsArk\Commands\Project\Idea;

use DreamsArk\Commands\Command;
use DreamsArk\Events\Idea\UserHasBiddenAnIdea;
use DreamsArk\Models\Idea\Idea;
use DreamsArk\Models\User\User;
use DreamsArk\Repositories\Project\Idea\IdeaRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class BidIdeaCommand extends Command implements SelfHandling
{
    /**
     * @var Idea
     */
    private $idea;

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new command instance.
     *
     * @param User $user
     * @param Idea $idea
     */
    public function __construct(User $user, Idea $idea)
    {
        $this->idea = $idea;
        $this->user = $user;
    }

    /**
     * Execute the command.
     *
     * @param IdeaRepositoryInterface $repository
     * @param Dispatcher $event
     */
    public function handle(IdeaRepositoryInterface $repository, Dispatcher $event)
    {
        /**
         * Bid User to Idea
         */
        $repository->bid($this->user->id, $this->idea->id);

        /**
         * Announce UserHasBiddenAnIdea
         */
        $event->fire(new UserHasBiddenAnIdea($this->user, $this->idea));

    }
}
