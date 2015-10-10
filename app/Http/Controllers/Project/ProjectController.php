<?php

namespace DreamsArk\Http\Controllers\Project;

use DreamsArk\Commands\Project\CreateProjectCommand;
use DreamsArk\Http\Requests\Project\ProjectCreation;
use DreamsArk\Models\Project;
use DreamsArk\Repositories\Project\ProjectRepositoryInterface;
use Illuminate\Http\Request;
use DreamsArk\Http\Requests;
use DreamsArk\Http\Controllers\Controller;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }


    /**
     * Show Projects Page
     *
     * @param ProjectRepositoryInterface $repository
     * @return \Illuminate\View\View
     */
    public function index(ProjectRepositoryInterface $repository)
    {
        return view('project.index')->with('projects', $repository->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public
    function create()
    {
        return view('project.create')->with('user', auth()->user());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectCreation|Request $request
     * @return \Illuminate\Http\Response
     */
    public
    function store(ProjectCreation $request)
    {
        $command = new CreateProjectCommand($request, $request->user());
        $this->dispatch($command);
        return redirect()->back();
    }

    /**
     * Show a specific project.
     *
     * @param Project $project
     * @return \Illuminate\View\View
     */
    public
    function show(Project $project)
    {
        return view('project.show', compact('project'));
    }

}
