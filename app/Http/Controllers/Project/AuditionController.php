<?php

namespace DreamsArk\Http\Controllers\Project;

use DreamsArk\Models\Project\Audition;
use DreamsArk\Repositories\Project\ProjectRepositoryInterface;
use DreamsArk\Http\Requests;
use DreamsArk\Http\Controllers\Controller;

class AuditionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param ProjectRepositoryInterface $repository
     * @return \Illuminate\Http\Response
     */
    public function index(ProjectRepositoryInterface $repository)
    {
        return view('project.audition.index')->with('auditions', $repository->auditions()->load('project'));
    }

    /**
     * Display the specified resource.
     *
     * @param Audition $audition
     * @return \Illuminate\Http\Response
     */
    public function show(Audition $audition)
    {
        return view('project.audition.show')->with('audition', $audition);
    }

}
