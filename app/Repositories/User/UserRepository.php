<?php

namespace DreamsArk\Repositories\User;

use DreamsArk\Models\User\User;
use DreamsArk\Repositories\Repository;
use Illuminate\Support\Collection;

class UserRepository extends Repository implements UserRepositoryInterface
{

    /**
     * @var User
     */
    public $model;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Returns all drafts for this user
     *
     * @param int $user_id
     * @return Collection
     */
    public function drafts($user_id)
    {
        return $this->model($user_id)->drafts;
    }

    /**
     * Returns all projects that this user has Published
     *
     * @param int $user_id
     * @return Collection
     */
    public function published($user_id)
    {
        $ideas = $this->model($user_id)->projects()
            ->join('ideas', 'projects.id', '=', 'ideas.project_id')->where('ideas.active', '=', true);

        $synapses = $this->model($user_id)->projects()
            ->join('synapses', 'projects.id', '=', 'synapses.project_id')->where('synapses.active', '=', true);

        return $this->model($user_id)->projects()
            ->join('scripts', 'projects.id', '=', 'scripts.project_id')->where('scripts.active', '=', true)
            ->union($ideas)
            ->union($synapses)
            ->get();
    }

    /**
     * Returns all failed project for this user
     *
     * @param int $user_id
     * @return Collection
     */
    public function failed($user_id)
    {
        $ideas = $this->model($user_id)->projects()
            ->join('ideas', 'projects.id', '=', 'ideas.project_id')->where('ideas.active', '=', 0);

        $synapses = $this->model($user_id)->projects()
            ->join('synapses', 'projects.id', '=', 'synapses.project_id')->where('synapses.active', '=', 0);

        return $this->model($user_id)->projects()
            ->join('scripts', 'projects.id', '=', 'scripts.project_id')->where('scripts.active', '=', 0)
            ->union($ideas)
            ->union($synapses)
            ->get();

    }

    /**
     * Returns all Active project for this user
     *
     * @param int $user_id
     * @return Collection
     */
    public function active($user_id)
    {
        return $this->model($user_id)->projects()->active()->get();
    }

}