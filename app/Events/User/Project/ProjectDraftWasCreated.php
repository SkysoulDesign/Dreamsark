<?php

namespace DreamsArk\Events\User\Project;

use DreamsArk\Events\Event;
use DreamsArk\Models\Project\Draft;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProjectDraftWasCreated extends Event
{
    use SerializesModels;

    /**
     * @var Draft
     */
    public $draft;

    /**
     * Create a new event instance.
     *
     * @param Draft $draft
     */
    public function __construct(Draft $draft)
    {
        $this->draft = $draft;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
