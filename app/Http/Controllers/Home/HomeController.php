<?php

namespace DreamsArk\Http\Controllers\Home;

use DreamsArk\Http\Controllers\Controller;
use DreamsArk\Http\Requests;
use DreamsArk\Models\User;
use Form;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Application $app
     * @return Response
     */
    public function index(Application $app)
    {
        return view('index')->with('user', User::find(1))->with('form', app('form'));
    }
}
