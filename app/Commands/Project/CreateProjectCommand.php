<?php

namespace DreamsArk\Commands\Project;

use Carbon\Carbon;
use DreamsArk\Commands\Command;
use DreamsArk\Commands\Project\Audition\CreateAuditionCommand;
use DreamsArk\Commands\Project\Idea\CreateIdeaCommand;
use DreamsArk\Events\Project\ProjectWasCreated;
use DreamsArk\Models\Project\Project;
use DreamsArk\Models\User\User;
use DreamsArk\Repositories\Project\ProjectRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;


class CreateProjectCommand extends Command implements SelfHandling
{

    use DispatchesJobs;

    /**
     * @var array
     */
    private $fields;

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new command instance.
     *
     * @param User $user
     * @param array $fields
     */
    public function __construct(User $user, array $fields)
    {
        $this->fields = collect($fields);
        $this->user = $user;
    }

    /**
     * Execute the command.
     *
     * @param ProjectRepositoryInterface $repository
     * @param Dispatcher $event
     * @return Project
     */
    public function handle(ProjectRepositoryInterface $repository, Dispatcher $event)
    {

        $type = $this->fields->get('type');
        $time = Carbon::parse($this->fields->get('audition_time', '11:00'));

        /** @var Carbon $audition_open_date */
        $audition_open_date = Carbon::parse($this->fields->get('audition_date'))->setTime($time->hour, $time->minute);
        $audition_close_date = $audition_open_date->copy()->addMinute();

        /**
         * Create Project
         */
        $project = $repository->create($this->user->id, $type, $this->fields->toArray());

        /**
         * Create Project Idea
         */
        if ($type == 'idea') {
            $this->dispatch(new CreateIdeaCommand($project->id, $this->fields->toArray()));
        }

        /**
         * Create Audition
         */
        $this->dispatch(new CreateAuditionCommand($project, $audition_open_date, $audition_close_date));

        /**
         * Announce ProjectWasCreated
         */
        $event->fire(new ProjectWasCreated($project));

        return $project;
    }
}
