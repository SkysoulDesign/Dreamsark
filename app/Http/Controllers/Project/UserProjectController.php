<?php

namespace DreamsArk\Http\Controllers\Project;

use DreamsArk\Repositories\Project\ProjectRepositoryInterface;
use DreamsArk\Http\Requests;
use DreamsArk\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ProjectRepositoryInterface $repository
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(ProjectRepositoryInterface $repository, Request $request)
    {
        return view('user.project.index')->with('projects', $repository->userProjects($request->user()->id));
    }

}
