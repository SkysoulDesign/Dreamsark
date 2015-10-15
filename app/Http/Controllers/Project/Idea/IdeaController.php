<?php

namespace DreamsArk\Http\Controllers\Project\Idea;

use DreamsArk\Commands\Project\CreateProjectCommand;
use DreamsArk\Commands\Project\Idea\BidIdeaCommand;
use DreamsArk\Commands\Project\Idea\CreateIdeaCommand;
use DreamsArk\Http\Requests\Project\IdeaCreation;
use DreamsArk\Http\Requests;
use DreamsArk\Http\Controllers\Controller;
use DreamsArk\Models\Idea\Idea;
use DreamsArk\Repositories\Project\Idea\IdeaRepositoryInterface;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    /**
     * IdeaController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show Ideas Page
     *
     * @param IdeaRepositoryInterface $repository
     * @return \Illuminate\View\View
     */
    public function index(IdeaRepositoryInterface $repository)
    {
        return view('idea.index')->with('ideas', $repository->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project.idea.create')->with('user', auth()->user());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param IdeaCreation $request
     * @return \Illuminate\Http\Response
     */
    public function store(IdeaCreation $request)
    {
        $command = new CreateProjectCommand($request->user(), $request);
        $this->dispatch($command);
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Idea $idea
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @internal param IdeaCreation $request
     */
    public function bid(Idea $idea, Request $request)
    {
        $command = new BidIdeaCommand($request->user(), $idea);
        $this->dispatch($command);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Idea $idea
     * @return \Illuminate\Http\Response
     */
    public function show(Idea $idea)
    {
        return view('project.idea.show')->with('idea', $idea->load('submissions.user'));
    }

}
