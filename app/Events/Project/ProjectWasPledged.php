<?php

namespace DreamsArk\Events\Project;

use DreamsArk\Events\Event;
use DreamsArk\Models\Project\Project;
use DreamsArk\Models\User;
use Illuminate\Queue\SerializesModels;

class ProjectWasPledged extends Event
{
    use SerializesModels;

    /**
     * @var Project
     */
    public $project;

    /**
     * @var User
     */
    public $user;

    /**
     * @var
     */
    public $amount;

    /**
     * Create a new event instance.
     *
     * @param Project $project
     * @param User $user
     * @param int $amount
     */
    public function __construct(Project $project, User $user, $amount)
    {
        $this->project = $project;
        $this->user = $user;
        $this->amount = $amount;
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
