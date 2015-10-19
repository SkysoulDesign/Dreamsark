<?php

namespace DreamsArk\Http\Controllers\Project\Idea;

use DreamsArk\Commands\Project\Idea\SubmitIdeaCommand;
use DreamsArk\Commands\Project\Submission\VoteOnSubmissionCommand;
use DreamsArk\Http\Controllers\Controller;
use DreamsArk\Http\Requests\Idea\IdeaSubmission;
use DreamsArk\Http\Requests\Idea\SubmissionVoting;
use DreamsArk\Models\Project\Idea\Idea;
use DreamsArk\Models\Project\Idea\Submission;

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

    /**
     * Vote on a Submission
     *
     * @param Submission $submission
     * @param SubmissionVoting $request
     * @return \Illuminate\Http\Response
     */
    public function vote(Submission $submission, SubmissionVoting $request)
    {
        $command = new VoteOnSubmissionCommand($request->get('amount'), $submission, $request->user());
        $this->dispatch($command);
        return redirect()->back();
    }

}
