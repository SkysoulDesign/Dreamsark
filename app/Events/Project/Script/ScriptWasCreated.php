<?php

namespace DreamsArk\Events\Project\Script;

use DreamsArk\Events\Event;
use DreamsArk\Models\Project\Script\Script;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ScriptWasCreated extends Event
{
    use SerializesModels;

    /**
     * @var Script
     */
    public $model;

    /**
     * Create a new event instance.
     *
     * @param Script $script
     */
    public function __construct(Script $script)
    {
        $this->model = $script;
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
