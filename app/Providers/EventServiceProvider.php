<?php

namespace DreamsArk\Providers;

use DreamsArk\Events\Bag\UserCoinsWasDeducted;
use DreamsArk\Events\Idea\IdeaWasSubmitted;
use DreamsArk\Events\Idea\UserHasBiddenAnIdea;
use DreamsArk\Events\Project\Audition\AuditionHasFailed;
use DreamsArk\Events\Project\Audition\AuditionHasFinished;
use DreamsArk\Events\Project\Audition\AuditionWasCreated;
use DreamsArk\Events\Project\Audition\AuditionWasOpened;
use DreamsArk\Events\Project\CastWasAdded;
use DreamsArk\Events\Project\CrewWasAdded;
use DreamsArk\Events\Project\IdeaWasCreated;
use DreamsArk\Events\Project\ProjectHasFailed;
use DreamsArk\Events\Project\ProjectWasCreated;
use DreamsArk\Events\Project\ProjectWasPledged;
use DreamsArk\Events\Project\Script\ScriptWasCreated;
use DreamsArk\Events\Project\TakeWasCreated;
use DreamsArk\Events\Project\UserHasEnrolledToCast;
use DreamsArk\Events\Session\UserWasCreated;
use DreamsArk\Events\Session\UserWasUpdated;
use DreamsArk\Events\Translation\TranslationsWasCreated;
use DreamsArk\Listeners\DeactivateAudition;
use DreamsArk\Listeners\Project\Audition\QueueCloseAuditionCommand;
use DreamsArk\Listeners\Project\Audition\QueueOpenAuditionCommand;
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

        /**
         * Audition
         */
        AuditionWasCreated::class => [
            QueueOpenAuditionCommand::class
        ],

        AuditionWasOpened::class => [
            QueueCloseAuditionCommand::class
        ],

        AuditionHasFailed::class => [
            DeactivateAudition::class,
        ],

        AuditionHasFinished::class => [
            DeactivateAudition::class,
        ],

        ProjectHasFailed::class => [

        ],

        UserWasCreated::class => [],
        UserWasUpdated::class => [],
        IdeaWasCreated::class => [],
        IdeaWasSubmitted::class => [],
        UserHasBiddenAnIdea::class => [],
        ProjectWasCreated::class => [],
        ProjectWasPledged::class => [],
        ScriptWasCreated::class => [],
        CastWasAdded::class => [],
        CrewWasAdded::class => [],
        UserHasEnrolledToCast::class => [],
        TakeWasCreated::class => [],
        TranslationsWasCreated::class => [],
        UserCoinsWasDeducted::class => []
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
