<?php

namespace DreamsArk\Listeners\Project;

use DreamsArk\Commands\Project\ChargeUserCommand;
use DreamsArk\Events\Event;
use DreamsArk\Events\Project\ProjectWasCreated;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChargeUser
{

    use DispatchesJobs;

    /**
     * Handle the event.
     *
     * @param  $event
     * @return void
     */
    public function handle(Event $event)
    {
        /**
         * Deduct Coins from the user
         */
        $this->dispatch(new ChargeUserCommand($event->model->user, $event->model->reward));
    }
}
