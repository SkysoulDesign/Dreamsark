<?php

namespace DreamsArk\Http\Controllers\Committee\Project;

use DreamsArk\Http\Controllers\Controller;
use DreamsArk\Http\Requests;
use DreamsArk\Models\Project\Project;
use DreamsArk\Repositories\Project\Expenditure\ExpenditureRepositoryInterface;

class StaffController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @param Project $project
     * @param ExpenditureRepositoryInterface $repository
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project, ExpenditureRepositoryInterface $repository)
    {
        $project = $project->load('expenditures.expenditurable');
        return view('committee.project.staff.create')->with('project', $project)->with('positions', $repository->positions()->sortBy('type'));
    }

}
