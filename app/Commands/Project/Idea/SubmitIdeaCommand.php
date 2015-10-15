<?php

namespace DreamsArk\Commands\Project\Idea;

use DreamsArk\Commands\Command;
use DreamsArk\Events\Idea\IdeaWasSubmitted;
use DreamsArk\Models\Idea\Idea;
use DreamsArk\Models\User\User;
use DreamsArk\Repositories\Project\Idea\IdeaRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class SubmitIdeaCommand extends Command implements SelfHandling
{
    /**
     * @var array
     */
    private $fields;

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
     * @param Idea $idea
     * @param User $user
     * @param array $fields
     */
    public function __construct(Idea $idea, User $user, array $fields)
    {
        $this->fields = $fields;
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
         * Submit Idea
         */
        $submission = $repository->submitIdea($this->idea->id, $this->user->id, $this->fields);

        /**
         * Announce IdeaWasSubmitted
         */
        $event->fire(new IdeaWasSubmitted($submission, $this->user));
    }
}
