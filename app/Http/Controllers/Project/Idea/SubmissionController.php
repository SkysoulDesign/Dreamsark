<?php

namespace DreamsArk\Http\Controllers\Project\Idea;

use DreamsArk\Commands\Project\Idea\SubmitIdeaCommand;
use DreamsArk\Http\Controllers\Controller;
use DreamsArk\Http\Requests\Idea\IdeaSubmission;
use DreamsArk\Models\Idea\Idea;

class SubmissionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Idea $idea
     * @param IdeaSubmission $request
     * @return \Illuminate\Http\Response
     */
    public function store(Idea $idea, IdeaSubmission $request)
    {
        $command = new SubmitIdeaCommand($idea, $request->user(), $request->all());
        $this->dispatch($command);
        return redirect()->back();
    }

}
