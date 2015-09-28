<?php

namespace DreamsArk\Http\Controllers\Session;

use Illuminate\Http\Request;
use DreamsArk\Http\Requests;
use DreamsArk\Http\Controllers\Controller;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('session.register');
    }

}
