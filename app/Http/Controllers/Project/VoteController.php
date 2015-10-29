<?php

namespace DreamsArk\Http\Controllers\Project;

use DreamsArk\Commands\Project\Vote\CloseVotingCommand;
use DreamsArk\Commands\Project\Vote\OpenVotingCommand;
use DreamsArk\Models\Project\Vote;
use DreamsArk\Repositories\Project\Vote\VoteRepositoryInterface;
use DreamsArk\Repositories\Project\ProjectRepositoryInterface;
use DreamsArk\Http\Requests;
use DreamsArk\Http\Controllers\Controller;

class VoteController extends Controller
{
    /**
     * VoteController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param VoteRepositoryInterface $repository
     * @return \Illuminate\Http\Response
     */
    public function index(VoteRepositoryInterface $repository)
    {
        return view('project.vote.index')->with('votes', $repository->allOpened()->load('project'));
    }

    /**
     * Display the specified resource.
     *
     * @param Vote $vote
     * @return \Illuminate\Http\Response
     */
    public function show(Vote $vote)
    {
        $this->dispatch(new CloseVotingCommand($vote));

        $submissions = $vote->votable->submissions->load('user', 'votes');
        return view('project.vote.show')->with('vote', $vote)->with('submissions', $submissions);
    }

}
