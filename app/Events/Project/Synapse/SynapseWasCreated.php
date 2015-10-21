<?php

namespace DreamsArk\Events\Project\Synapse;

use DreamsArk\Events\Event;
use DreamsArk\Models\Project\Synapse\Synapse;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SynapseWasCreated extends Event
{
    use SerializesModels;

    /**
     * @var Synapse
     */
    public $synapse;

    /**
     * Create a new event instance.
     *
     * @param Synapse $synapse
     */
    public function __construct(Synapse $synapse)
    {
        $this->synapse = $synapse;
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
