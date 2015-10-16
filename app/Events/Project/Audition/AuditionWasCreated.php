<?php

namespace DreamsArk\Events\Project\Audition;

use DreamsArk\Events\Event;
use DreamsArk\Models\Project\Audition;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AuditionWasCreated extends Event
{
    use SerializesModels;

    /**
     * @var Audition
     */
    public $audition;

    /**
     * Create a new event instance.
     *
     * @param Audition $audition
     */
    public function __construct(Audition $audition)
    {
        $this->audition = $audition;
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
