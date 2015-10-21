<?php

namespace DreamsArk\Events\Project\Submission;

use DreamsArk\Events\Event;
use DreamsArk\Models\Project\Submission;
use DreamsArk\Models\User\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SubmissionReceivedAVote extends Event
{
    use SerializesModels;

    /**
     * @var Submission
     */
    public $submission;

    /**
     * @var User
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param Submission $submission
     * @param User $user
     */
    public function __construct(Submission $submission, User $user)
    {
        $this->submission = $submission;
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
