<?php

namespace DreamsArk\Events\Project;

use DreamsArk\Events\Event;
use DreamsArk\Models\Project\Take;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TakeWasCreated extends Event
{
    use SerializesModels;

    /**
     * @var Take
     */
    public $take;

    /**
     * Create a new event instance.
     * @param Take $take
     */
    public function __construct(Take $take)
    {
        $this->take = $take;
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
