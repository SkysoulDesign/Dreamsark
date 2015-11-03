<?php

namespace DreamsArk\Events\Project\Expenditure;

use DreamsArk\Events\Event;
use DreamsArk\Models\Project\Expenditures\Expenditure;
use DreamsArk\Models\User\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ExpenditureWasBacked extends Event
{
    use SerializesModels;

    /**
     * @var Expenditure
     */
    public $expenditure;

    /**
     * @var User
     */
    public $user;

    /**
     * @var
     */
    public $amount;

    /**
     * Create a new command instance.
     *
     * @param Expenditure $expenditure
     * @param User $user
     * @param $amount
     */
    public function __construct(Expenditure $expenditure, User $user, $amount)
    {
        $this->expenditure = $expenditure;
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
