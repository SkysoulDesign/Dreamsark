<?php

namespace DreamsArk\Http\Controllers\Home;

use DreamsArk\Commands\Project\Audition\CreateAuditionCommand;
use DreamsArk\Http\Controllers\Controller;
use DreamsArk\Http\Requests;
use DreamsArk\Models\Idea\Idea;
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

//        $this->dispatch(new CreateAuditionCommand(Idea::find(5)));

        return view('index');
    }
}
