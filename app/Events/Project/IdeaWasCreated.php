<?php

namespace DreamsArk\Events\Project;

use DreamsArk\Events\Event;
use DreamsArk\Models\Project\Idea\Idea;
use Illuminate\Queue\SerializesModels;

class IdeaWasCreated extends Event
{
    use SerializesModels;

    /**
     * @var Idea
     */
    public $model;

    /**
     * Create a new event instance.
     *
     * @param Idea $idea
     */
    public function __construct(Idea $idea)
    {
        $this->model = $idea;
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
