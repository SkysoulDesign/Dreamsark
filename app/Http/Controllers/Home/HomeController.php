<?php

namespace DreamsArk\Http\Controllers\Home;

use DreamsArk\Http\Controllers\Controller;
use DreamsArk\Http\Requests;
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
