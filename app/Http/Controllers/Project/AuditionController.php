<?php

namespace DreamsArk\Http\Controllers\Project;

use DreamsArk\Commands\Project\Audition\CloseAuditionCommand;
use DreamsArk\Models\Project\Audition;
use DreamsArk\Repositories\Project\Audition\AuditionRepositoryInterface;
use DreamsArk\Repositories\Project\ProjectRepositoryInterface;
use DreamsArk\Http\Requests;
use DreamsArk\Http\Controllers\Controller;

class AuditionController extends Controller
{
    /**
     * AuditionController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param AuditionRepositoryInterface $repository
     * @return \Illuminate\Http\Response
     */
    public function index(AuditionRepositoryInterface $repository)
    {
        return view('project.audition.index')->with('auditions', $repository->all()->load('project'));
    }

    /**
     * Display the specified resource.
     *
     * @param Audition $audition
     * @return \Illuminate\Http\Response
     */
    public function show(Audition $audition)
    {
        $this->dispatch(new CloseAuditionCommand($audition));
        return view('project.audition.show')->with('audition', $audition->load('project.submissions.user'));
    }

}
