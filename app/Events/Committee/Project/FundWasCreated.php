<?php

namespace DreamsArk\Events\Committee\Project;

use DreamsArk\Events\Event;
use DreamsArk\Models\Project\Stages\Fund;
use DreamsArk\Models\Project\Stages\Review;
use Illuminate\Queue\SerializesModels;

class FundWasCreated extends Event
{
    use SerializesModels;

    /**
     * @var Review
     */
    public $model;

    /**
     * Create a new event instance.
     *
     * @param Fund $fund
     */
    public function __construct(Fund $fund)
    {
        $this->model = $fund;
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
