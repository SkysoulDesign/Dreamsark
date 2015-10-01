<?php

namespace DreamsArk\Http\Controllers\Report;

use DreamsArk\Commands\Report\CreateReportCommand;
use Illuminate\Http\Request;
use DreamsArk\Http\Requests;
use DreamsArk\Http\Controllers\Controller;
use Route;

class ReportController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $command = new CreateReportCommand($request->all());

        $this->dispatch($command);

        return redirect()->back();
    }

}
