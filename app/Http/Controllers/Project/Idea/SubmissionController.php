<?php

namespace DreamsArk\Http\Controllers\Project\Idea;

use DreamsArk\Commands\Project\Idea\SubmitIdeaCommand;
use DreamsArk\Commands\Project\Submission\VoteOnSubmissionCommand;
use DreamsArk\Http\Controllers\Controller;
use DreamsArk\Http\Requests\Idea\IdeaSubmission;
use DreamsArk\Models\Project\Idea\Idea;
use DreamsArk\Models\Project\Idea\Submission;
use Illuminate\Http\Request;

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
        $command = new SubmitIdeaCommand($idea, $request->user(), $request->only('content'));
        $this->dispatch($command);
        return redirect()->back();
    }

    /**
     * Vote on a Submission
     *
     * @param Submission $submission
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function vote(Submission $submission, Request $request)
    {
        $command = new VoteOnSubmissionCommand($submission, $request->user());
        $this->dispatch($command);
        return redirect()->back();
    }

}
