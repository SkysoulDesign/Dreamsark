<?php

namespace DreamsArk\Http\Controllers\Project;

use DreamsArk\Repositories\Idea\IdeaRepositoryInterface;
use DreamsArk\Repositories\Project\ProjectRepositoryInterface;
use DreamsArk\Http\Requests;
use DreamsArk\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ProjectRepositoryInterface $projectRepository
     * @param IdeaRepositoryInterface $ideaRepository
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(ProjectRepositoryInterface $projectRepository, IdeaRepositoryInterface $ideaRepository, Request $request)
    {
        $user_id = $request->user()->id;
        $projects = $projectRepository->userProjects($user_id);
        $bids = $ideaRepository->bids($user_id);
        return view('user.project.index', compact('projects', 'bids'));
    }

}
