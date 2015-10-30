<?php

namespace DreamsArk\Http\Controllers\Home;

use DreamsArk\Http\Controllers\Controller;
use DreamsArk\Http\Requests;
use DreamsArk\Models\Project\Stages\Idea;
use DreamsArk\Models\Project\Project;
use DreamsArk\Models\Project\Stage;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('index');
    }
}
