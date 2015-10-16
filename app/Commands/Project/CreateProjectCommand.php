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
    private $request;

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new command instance.
     *
     * @param User $user
     * @param Request $request
     */
    public function __construct(User $user, Request $request)
    {
        $this->request = $request;
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

        $stage = $this->request->get('type');
        $time = Carbon::parse($this->request->get('audition_time'));
        /** @var Carbon $audition_open_date */
        $audition_open_date = Carbon::parse($this->request->get('audition_date'))->setTime($time->hour, $time->minute);
        $audition_close_date = $audition_open_date->copy()->addMinute();

        /**
         * Create Project
         */
        $project = $repository->create($this->user->id, $stage, $this->request->all());

        /**
         * Create Project Idea
         */
        if ($stage == 'idea') {
            $this->dispatch(new CreateIdeaCommand($project->id, $this->request->all()));
        }

        /**
         * Create Audition
         */
        $this->dispatch(new CreateAuditionCommand($project, $audition_open_date, $audition_close_date));

        /**
         * Announce ProjectWasCreated
         */
        $event->fire(new ProjectWasCreated($project));

    }
}
