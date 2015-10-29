<?php

namespace DreamsArk\Providers;

use DreamsArk\Events\Bag\UserCoinsWasDeducted;
use DreamsArk\Events\Idea\IdeaWasSubmitted;
use DreamsArk\Events\Idea\UserHasBiddenAnIdea;
use DreamsArk\Events\Project\StageHasFailed;
use DreamsArk\Events\Project\Synapse\SynapseWasCreated;
use DreamsArk\Events\Project\Vote\VoteHasFailed;
use DreamsArk\Events\Project\Vote\VotingHasFinished;
use DreamsArk\Events\Project\Vote\VoteWasCreated;
use DreamsArk\Events\Project\Vote\VoteWasOpened;
use DreamsArk\Events\Project\CastWasAdded;
use DreamsArk\Events\Project\CrewWasAdded;
use DreamsArk\Events\Project\IdeaWasCreated;
use DreamsArk\Events\Project\ProjectWasCreated;
use DreamsArk\Events\Project\ProjectWasPledged;
use DreamsArk\Events\Project\Script\ScriptWasCreated;
use DreamsArk\Events\Project\TakeWasCreated;
use DreamsArk\Events\Project\UserHasEnrolledToCast;
use DreamsArk\Events\Session\UserWasCreated;
use DreamsArk\Events\Session\UserWasUpdated;
use DreamsArk\Events\Translation\TranslationsWasCreated;
use DreamsArk\Listeners\Project\Vote\CheckIfIsTheLastStage;
use DreamsArk\Listeners\Project\Vote\DeactivateVoting;
use DreamsArk\Listeners\Project\ChargeUser;
use DreamsArk\Listeners\Project\CreateProjectStage;
use DreamsArk\Listeners\Project\CreateVote;
use DreamsArk\Listeners\Project\RefundUser;
use DreamsArk\Listeners\Project\RefundUsers;
use DreamsArk\Listeners\Project\RegisterVotingWinner;
use DreamsArk\Listeners\Project\UpdateProjectStage;
use DreamsArk\Listeners\Project\Vote\QueueCloseVotingCommand;
use DreamsArk\Listeners\Project\Vote\QueueOpenVotingCommand;
use DreamsArk\Listeners\User\AppendDefaultSettings;
use DreamsArk\Listeners\User\GiveUserAnEmptyBag;
use DreamsArk\Listeners\User\AttachUserRole;
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
         * Project
         */
        ProjectWasCreated::class => [
            CreateProjectStage::class
        ],

        StageHasFailed::class => [
            RefundUser::class
        ],

        IdeaWasCreated::class => [
            ChargeUser::class,
            CreateVote::class,
            UpdateProjectStage::class
        ],

        SynapseWasCreated::class => [
            ChargeUser::class,
            CreateVote::class,
            UpdateProjectStage::class
        ],

        ScriptWasCreated::class => [
            ChargeUser::class,
            CreateVote::class,
            UpdateProjectStage::class
        ],

        /**
         * Vote
         */
        VoteWasCreated::class => [
            QueueOpenVotingCommand::class
        ],

        VoteWasOpened::class => [
            QueueCloseVotingCommand::class
        ],

        VoteHasFailed::class => [
            DeactivateVoting::class,
        ],

        VotingHasFinished::class => [
            DeactivateVoting::class,
            RefundUsers::class,
            RegisterVotingWinner::class,
            CheckIfIsTheLastStage::class,
        ],

        UserWasCreated::class => [
            AppendDefaultSettings::class,
            GiveUserAnEmptyBag::class,
            AttachUserRole::class
        ],

        UserWasUpdated::class => [],

        IdeaWasSubmitted::class => [],
        UserHasBiddenAnIdea::class => [],

        ProjectWasPledged::class => [],

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
