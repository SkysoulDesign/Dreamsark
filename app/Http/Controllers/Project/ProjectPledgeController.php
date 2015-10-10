<?php

namespace DreamsArk\Http\Controllers\Project;

use DreamsArk\Commands\Project\PledgeProjectCommand;
use DreamsArk\Models\Project;
use Illuminate\Http\Request;
use DreamsArk\Http\Requests;
use DreamsArk\Http\Controllers\Controller;

class ProjectPledgeController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @param Project $project
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        return view('project.pledge.create', compact('project'))->with('user', auth()->user());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Project $project
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Project $project, Request $request)
    {
        $command = new PledgeProjectCommand($project, $request->user(), $request->get('amount'));
        $this->dispatch($command);
        return redirect()->back();
    }

}
