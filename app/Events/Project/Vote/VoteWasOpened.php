<?php

namespace DreamsArk\Events\Project\Vote;

use DreamsArk\Events\Event;
use DreamsArk\Models\Project\Vote;
use Illuminate\Queue\SerializesModels;

class VoteWasOpened extends Event
{
    use SerializesModels;

    /**
     * @var Vote
     */
    public $vote;

    /**
     * Create a new event instance.
     *
     * @param Vote $vote
     */
    public function __construct(Vote $vote)
    {
        $this->vote = $vote;
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
