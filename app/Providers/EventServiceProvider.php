<?php

namespace DreamsArk\Providers;

use DreamsArk\Events\Project\CastWasAdded;
use DreamsArk\Events\Project\CrewWasAdded;
use DreamsArk\Events\Project\ProjectWasCreated;
use DreamsArk\Events\Project\ProjectWasPledged;
use DreamsArk\Events\Project\ScriptWasCreated;
use DreamsArk\Events\Project\TakeWasCreated;
use DreamsArk\Events\Project\UserHasEnrolledToCast;
use DreamsArk\Events\Session\UserWasCreated;
use DreamsArk\Events\Session\UserWasUpdated;
use DreamsArk\Events\Translation\TranslationsWasCreated;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserWasCreated::class => [],
        UserWasUpdated::class => [],
        ProjectWasCreated::class => [],
        ProjectWasPledged::class => [],
        ScriptWasCreated::class => [],
        CastWasAdded::class => [],
        CrewWasAdded::class => [],
        UserHasEnrolledToCast::class => [],
        TakeWasCreated::class => [],
        TranslationsWasCreated::class => [],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
    }

}
