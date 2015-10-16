<?php

namespace DreamsArk\Repositories\Project;

use DreamsArk\Models\Project\Audition;
use DreamsArk\Models\Project\Cast;
use DreamsArk\Models\Project\Crew;
use DreamsArk\Models\Project\Project;
use DreamsArk\Models\Project\Script;
use DreamsArk\Models\Project\Take;
use DreamsArk\Repositories\Project\Idea\IdeaRepository;
use DreamsArk\Repositories\Project\Idea\IdeaRepositoryInterface;
use DreamsArk\Repositories\RepositoryHelperTrait;
use ErrorException;
use Illuminate\Support\Collection;
use Prophecy\Exception\Doubler\MethodNotFoundException;

class ProjectRepository implements ProjectRepositoryInterface
{

    use RepositoryHelperTrait;

    /**
     * @var Project
     */
    public $model;

    /**
     * @param Project $project
     * @internal param Take $take
     * @internal param Cast $cast
     * @internal param Crew $crew
     * @internal param Audition $audition
     */
    function __construct(Project $project)
    {
        $this->model = $project;
    }

    /**
     * Create a Idea
     *
     * @param int $user_id
     * @param int $stage
     * @param array $fields
     * @return Project
     */
    public function create($user_id, $stage, array $fields)
    {
        $project = $this->model
            ->setAttribute('user_id', $user_id)
            ->setAttribute('stage', $stage)
            ->fill($fields);
        $project->save();
        return $project;
    }

}