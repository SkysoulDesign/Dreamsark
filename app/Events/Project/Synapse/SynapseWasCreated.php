<?php

namespace DreamsArk\Events\Project\Synapse;

use DreamsArk\Events\Event;
use DreamsArk\Models\Project\Stages\Synapse;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SynapseWasCreated extends Event
{
    use SerializesModels;

    /**
     * @var \DreamsArk\Models\Project\Stages\Synapse
     */
    public $model;

    /**
     * @var
     */
    public $voting_date;

    /**
     * Create a new event instance.
     *
     * @param \DreamsArk\Models\Project\Stages\Synapse $synapse
     * @param $voting_date
     */
    public function __construct(\DreamsArk\Models\Project\Stages\Synapse $synapse, $voting_date)
    {
        $this->model = $synapse;
        $this->voting_date = $voting_date;
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
