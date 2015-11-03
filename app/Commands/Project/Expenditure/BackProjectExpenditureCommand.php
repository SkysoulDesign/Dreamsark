<?php

namespace DreamsArk\Commands\Project\Expenditure;

use DreamsArk\Commands\Command;
use DreamsArk\Events\Project\Expenditure\ExpenditureWasBacked;
use DreamsArk\Models\Project\Expenditures\Expenditure;
use DreamsArk\Models\User\User;
use DreamsArk\Repositories\Project\Expenditure\ExpenditureRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class BackProjectExpenditureCommand extends Command implements SelfHandling
{
    /**
     * @var Expenditure
     */
    private $expenditure;

    /**
     * @var User
     */
    private $user;

    /**
     * @var
     */
    private $amount;

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
     * Execute the command.
     *
     * @param ExpenditureRepositoryInterface $repository
     * @param Dispatcher $event
     */
    public function handle(ExpenditureRepositoryInterface $repository, Dispatcher $event)
    {
        /**
         * Back Expenditure
         */
        $repository->back($this->expenditure->id, $this->user->id, $this->amount);

        /**
         * Announce ExpenditureWasBacked
         */
        $event->fire(new ExpenditureWasBacked($this->expenditure, $this->user, $this->amount));
    }
}
