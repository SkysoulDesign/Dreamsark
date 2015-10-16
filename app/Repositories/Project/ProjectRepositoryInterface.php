<?php

namespace DreamsArk\Repositories\Project;

use DreamsArk\Models\Project\Cast;
use DreamsArk\Models\Project\Crew;
use DreamsArk\Models\Project\Project;
use DreamsArk\Models\Project\Script;
use DreamsArk\Models\Project\Take;
use DreamsArk\Repositories\Project\Idea\IdeaRepository;
use Illuminate\Support\Collection;

interface ProjectRepositoryInterface
{

    /**
     * Create a Project
     *
     * @param int $user_id
     * @param string $stage
     * @param array $fields
     * @return Project
     */
    public function create($user_id, $stage, array $fields);

}