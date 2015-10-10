<?php

namespace DreamsArk\Providers;

use DreamsArk\Repositories\Project\ProjectRepository;
use DreamsArk\Repositories\Project\ProjectRepositoryInterface;
use DreamsArk\Repositories\Setting\SettingRepository;
use DreamsArk\Repositories\Setting\SettingRepositoryInterface;
use DreamsArk\Repositories\Translation\TranslationRepository;
use DreamsArk\Repositories\Translation\TranslationRepositoryInterface;
use DreamsArk\Repositories\User\UserRepository;
use DreamsArk\Repositories\User\UserRepositoryInterface;
use DreamsArk\Repositories\Report\ReportRepository;
use DreamsArk\Repositories\Report\ReportRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * User Repository
         */
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        /**
         * Setting Repository
         */
        $this->app->bind(
            SettingRepositoryInterface::class,
            SettingRepository::class
        );

        /**
         * Report Repository
         */
        $this->app->bind(
            ReportRepositoryInterface::class,
            ReportRepository::class
        );

        /**
         * Translation Repository
         */
        $this->app->bind(
            TranslationRepositoryInterface::class,
            TranslationRepository::class
        );

        /**
         * Project Repository
         */
        $this->app->bind(
            ProjectRepositoryInterface::class,
            ProjectRepository::class
        );

    }
}
