<?php

namespace Skysoul\SemanticForm;

use Illuminate\Support\ServiceProvider;

class SemanticFormServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('semantic-form', function ($app) {
            return new FormBuilder();
        });
    }

}