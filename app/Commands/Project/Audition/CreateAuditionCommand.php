<?php

namespace DreamsArk\Commands\Project\Audition;

use DreamsArk\Commands\Command;
use DreamsArk\Models\Project\Audition;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;

class CreateAuditionCommand extends Command implements SelfHandling, ShouldQueue
{
    /**
     * @var Model
     */
    private $model;

    /**
     * Create a new command instance.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Execute the command.
     *
     * @param Audition $repository
     */
    public function handle(Audition $repository)
    {
        dd($this->model);

        /**
         * Deactivate Model
         */
        $this->model->repository->deactivate();

        /**
         *
         */
        $repository->create();
    }
}
