<?php

namespace DreamsArk\Listeners;

use DreamsArk\Events\Event;
use DreamsArk\Repositories\Project\Audition\AuditionRepositoryInterface;

class DeactivateAudition
{
    /**
     * @var AuditionRepositoryInterface
     */
    private $repository;

    /**
     * Create the event listener.
     * @param AuditionRepositoryInterface $repository
     */
    public function __construct(AuditionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle the event.
     *
     * @param Event $event
     */
    public function handle(Event $event)
    {
        $this->repository->deactivate($event->audition->id);
    }
}
