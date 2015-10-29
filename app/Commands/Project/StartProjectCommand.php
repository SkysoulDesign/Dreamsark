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
     * Create a new command instance.
     *
     * @param Project $project
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        dd($this->project->name);
    }
}
