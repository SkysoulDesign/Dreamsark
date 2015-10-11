<?php

namespace DreamsArk\Providers;

use DreamsArk\Events\Project\ProjectWasCreated;
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
