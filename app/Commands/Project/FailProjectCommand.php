<?php

namespace DreamsArk\Commands\Project;

use DreamsArk\Commands\Command;
use DreamsArk\Commands\Bag\RefundUserCommand;
use DreamsArk\Events\Project\ProjectHasFailed;
use DreamsArk\Models\Project\Project;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\DispatchesJobs;

class FailProjectCommand extends Command implements SelfHandling
{

    use DispatchesJobs;

    /**
     * @var Project
     */
    private $model;

    /**
     * Create a new command instance.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Execute the command.
     *
     * @param Dispatcher $event
     */
    public function handle(Dispatcher $event)
    {
        /**
         * If it`s not a Project Instance then initialize its repository and fail it
         */
        app()->make($this->model->repository)->fail($this->model->id);

        /**
         * Set Reward
         */
        $reward = $this->model->reward ?: $this->model->stage()->reward;

        /**
         * Refund Project Owner
         */
        $this->dispatch(new RefundUserCommand($reward, $this->model->user));

        /**
         * Announce ProjectHasFailed
         */
        $event->fire(new ProjectHasFailed($this->model->project ?: $this->model));

    }
}
