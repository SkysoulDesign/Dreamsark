<?php

namespace DreamsArk\Listeners\Project\Audition;

use Carbon\Carbon;
use DreamsArk\Commands\Project\Audition\CloseAuditionCommand;
use DreamsArk\Commands\Project\Audition\OpenAuditionCommand;
use DreamsArk\Events\Project\Audition\AuditionWasCreated;
use DreamsArk\Models\Project\Project;
use Illuminate\Queue\DatabaseQueue;
use Illuminate\Queue\QueueManager;

class QueueCloseAuditionCommand
{

    /**
     * @var QueueManager
     */
    private $queue;

    /**
     * @var Carbon
     */
    private $carbon;

    /**
     * QueueOpenAuditionCommand constructor.
     * @param DatabaseQueue|QueueManager $queue
     * @param Carbon $carbon
     */
    public function __construct(QueueManager $queue, Carbon $carbon)
    {
        $this->queue = $queue;
        $this->carbon = $carbon;
    }

    /**
     * Handle the event.
     *
     * @param  AuditionWasCreated $event
     * @return void
     */
    public function handle(AuditionWasCreated $event)
    {

        /**
         * Queue OpenAuditionCommand
         */
        $command = new CloseAuditionCommand($event->audition);

        $delay = $event->audition->close_date->timestamp - $this->carbon->now()->timestamp;

        $this->queue->laterOn('close-audition', $delay, $command);

    }

}
