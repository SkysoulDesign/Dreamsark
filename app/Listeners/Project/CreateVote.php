<?php

namespace DreamsArk\Listeners\Project;


use Carbon\Carbon;
use DreamsArk\Commands\Project\Vote\CreateVotingCommand;
use DreamsArk\Events\Event;
use Illuminate\Foundation\Bus\DispatchesJobs;

class CreateVote
{

    use DispatchesJobs;

    /**
     * @var Carbon
     */
    private $carbon;

    /**
     * Create the event listener.
     *
     * @param Carbon $carbon
     */
    public function __construct(Carbon $carbon)
    {
        $this->carbon = $carbon;
    }

    /**
     * Handle the event.
     *
     * @param  Event $event
     * @return void
     */
    public function handle(Event $event)
    {

        /**
         * Create Voting
         */
        $vote_open_date = $this->carbon->parse();
        $vote_close_date = $vote_open_date->copy()->addMinutes(5);

        $this->dispatch(new CreateVotingCommand($event->model, $vote_open_date, $vote_close_date));

    }
}
