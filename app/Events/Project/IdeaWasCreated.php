<?php

namespace DreamsArk\Events\Project;

use DreamsArk\Events\Event;
use DreamsArk\Models\Idea\Idea;
use Illuminate\Queue\SerializesModels;

class IdeaWasCreated extends Event
{
    use SerializesModels;

    /**
     * @var Idea
     */
    public $idea;

    /**
     * Create a new event instance.
     *
     * @param Idea $idea
     */
    public function __construct(Idea $idea)
    {
        $this->idea = $idea;
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
