<?php

namespace DreamsArk\Providers;

use DreamsArk\Models\Project\Audition;
use DreamsArk\Models\Project\Cast;
use DreamsArk\Models\Project\Crew;
use DreamsArk\Models\Project\Draft;
use DreamsArk\Models\Project\Idea\Idea;
use DreamsArk\Models\Project\Submission;
use DreamsArk\Models\Project\Project;
use DreamsArk\Models\Project\Script;
use DreamsArk\Models\Project\Take;
use DreamsArk\Models\User\Setting;
use DreamsArk\Models\User\User;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'DreamsArk\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);

        /**
         * Route Model Binding
         */
        $router->model('user', User::class);
        $router->model('setting', Setting::class);
        $router->model('idea', Idea::class);
        $router->model('submission', Submission::class);
        $router->model('project', Project::class);
        $router->model('draft', Draft::class);
        $router->model('audition', Audition::class);
        $router->model('script', Script::class);
        $router->model('take', Take::class);
        $router->model('cast', Cast::class);
        $router->model('crew', Crew::class);

    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
