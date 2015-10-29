<?php

namespace DreamsArk\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use DreamsArk\Http\Requests;
use DreamsArk\Http\Controllers\Controller;

class DashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.index');
    }

}