<?php

namespace DreamsArk\Http\Controllers\Project;

use DreamsArk\Commands\Project\Vote\OpenVotingCommand;
use DreamsArk\Commands\Project\CreateProjectCommand;
use DreamsArk\Http\Requests\Project\ProjectCreation;
use DreamsArk\Models\Project\Project;
use DreamsArk\Repositories\Project\ProjectRepositoryInterface;
use DreamsArk\Repositories\Project\Submission\SubmissionRepositoryInterface;
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
        return view('project.index')->with('projects', $repository->actives());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project.create')->with('user', auth()->user());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectCreation|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectCreation $request)
    {
        $command = new CreateProjectCommand($request->user(), $request->all());
        $project = $this->dispatch($command);
        return redirect()->route('project.show', $project->id);
    }

    /**
     * Show a specific project.
     *
     * @param Project $project
     * @param ProjectRepositoryInterface $repository
     * @return \Illuminate\View\View
     */
    public function show(Project $project, ProjectRepositoryInterface $repository)
    {
        $submissions = $repository->submissions($project->id)->load('user');
        return view('project.show', compact('project'))->with('submissions', $submissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Project $project
     * @return \Illuminate\Http\Response
     */
    public function next(Project $project)
    {
        return view('project.' . $project->nextStageName() . '.create')->with('project', $project);
    }

}
