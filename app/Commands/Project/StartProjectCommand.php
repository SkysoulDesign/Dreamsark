<?php

namespace DreamsArk\Commands\Project;

use DreamsArk\Commands\Command;
use DreamsArk\Models\Project\Project;
use Illuminate\Contracts\Bus\SelfHandling;

class StartProjectCommand extends Command implements SelfHandling
{
    /**
     * @var Project
     */
    private $project;

    /**
     * @var array
     */
    private $fields;

    /**
     * Create a new command instance.
     *
     * @param Project $project
     * @param array $fields
     */
    public function __construct(Project $project, array $fields)
    {
        $this->project = $project;
        $this->fields = collect($fields);
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {

        $casts = collect($this->fields->pull('casts'));
        $castsPosition = collect($this->fields->pull('casts-position'));
        $castsSalary = collect($this->fields->pull('casts-salary'));

        $crewsPosition = collect($this->fields->pull('crews-position'));
        $crewsSalary = collect($this->fields->pull('crews-salary'));

        $cast = $casts->zip($castsPosition, $castsSalary);
        $crew = $crewsPosition->zip($crewsSalary);

        /**
         * Create Cast For the project
         */
        $cast->each(function($cast){
            dd($cast);
        });

    }
}
