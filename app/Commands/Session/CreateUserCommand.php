<?php

namespace DreamsArk\Commands\Session;

use DreamsArk\Commands\Command;
use DreamsArk\Events\Session\UserWasCreated;
use DreamsArk\Repositories\Setting\SettingRepositoryInterface;
use DreamsArk\Repositories\User\UserRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class CreateUserCommand extends Command implements SelfHandling
{
    /**
     * @var array
     */
    private $fields;

    /**
     * Create a new command instance.
     * @param array $fields
     */
    public function __construct(array $fields)
    {
        $this->fields = $fields;
    }

    /**
     * Execute the command.
     *
     * @param UserRepositoryInterface $repository
     * @param SettingRepositoryInterface $settings
     * @param Dispatcher $event
     * @return \DreamsArk\Models\User
     */
    public function handle(UserRepositoryInterface $repository, SettingRepositoryInterface $settings, Dispatcher $event)
    {
        /**
         * Create User
         */
        $user = $repository->create($this->fields);

        /**
         * Assign Default Settings
         */
        $settings->createDefault($user->id);

        /**
         * Announce UserWasCreated
         */
        $event->fire(new UserWasCreated($user));

        return $user;

    }
}
