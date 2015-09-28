<?php

namespace DreamsArk\Http\Controllers\Auth;

use DreamsArk\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Auth\AuthManager;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    use ThrottlesLogins;

    /**
     * @param Application $app
     * @param AuthManager $auth
     */
    function __construct(Application $app, AuthManager $auth)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->app = $app;
        $this->auth = $auth;
    }

    /**
     * Show Login Page
     *
     * @return \Illuminate\View\View
     */
    public function login()
    {
        return view("auth.login");
    }

    /**
     * Post the Login form
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($this->auth->attempt(['email' => $request->get('email'), 'password' => $request->get('password')], $request->has('remember'))) {
            return redirect()->intended(route('home'));
        }

        return redirect()->route('login')->withInput();

    }

    /**
     * Log the User out of the system
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        $this->auth->logout();
        return redirect()->route('login');
    }

}
