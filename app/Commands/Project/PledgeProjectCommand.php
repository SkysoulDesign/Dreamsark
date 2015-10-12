<?php

namespace DreamsArk\Commands\Project;

use DreamsArk\Commands\Bag\DeductCoinCommand;
use DreamsArk\Commands\Command;
use DreamsArk\Events\Project\ProjectWasPledged;
use DreamsArk\Models\Project\Project;
use DreamsArk\Models\User;
use DreamsArk\Repositories\Project\ProjectRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Bus\DispatchesJobs;

class PledgeProjectCommand extends Command implements SelfHandling
{

    use DispatchesJobs;

    /**
     * @var
     */
    private $amount;

    /**
     * @var
     */
    private $project;

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new command instance.
     *
     * @param Project $project
     * @param User $user
     * @param int $amount
     */
    public function __construct(Project $project, User $user, $amount)
    {
        $this->amount = $amount;
        $this->project = $project;
        $this->user = $user;
    }

    /**
     * Execute the command.
     *
     * @param ProjectRepositoryInterface $repository
     * @param Dispatcher $event
     */
    public function handle(ProjectRepositoryInterface $repository, Dispatcher $event)
    {
        /**
         * Pledge Project
         */
        $repository->pledge($this->project->id, $this->user->id, $this->amount);

        /**
         * Deduct User bag Coins
         */
        $command = new DeductCoinCommand($this->user->bag->id, $this->amount);
        $this->dispatch($command);

        /**
         * Announce ProjectWasPledged
         */
        $event->fire(new ProjectWasPledged($this->project, $this->user, $this->amount));

    }
}
