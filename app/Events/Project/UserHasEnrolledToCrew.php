<?php

namespace DreamsArk\Events\Project;

use DreamsArk\Events\Event;
use DreamsArk\Models\Project\Crew;
use DreamsArk\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserHasEnrolledToCrew extends Event
{
    use SerializesModels;

    /**
     * @var Crew
     */
    public $crew;

    /**
     * @var User
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param Crew $crew
     */
    public function __construct(User $user, Crew $crew)
    {
        $this->crew = $crew;
        $this->user = $user;
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
