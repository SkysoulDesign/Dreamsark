<?php

namespace DreamsArk\Http\Controllers\Session;

use DreamsArk\Commands\Session\CreateUserCommand;
use DreamsArk\Commands\Session\UpdateUserCommand;
use DreamsArk\Http\Requests\Session\UserCreation;
use DreamsArk\Http\Requests\Session\UserEdition;
use DreamsArk\Repositories\User\UserRepositoryInterface;
use DreamsArk\Http\Requests;
use DreamsArk\Http\Controllers\Controller;
use Illuminate\Auth\AuthManager;

class SessionController extends Controller
{

    /**
     * @var AuthManager
     */
    private $auth;

    /**
     * SessionController constructor.
     * @param AuthManager $auth
     */
    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Display Profile Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('session.profile');
    }

    /**
     * Display a registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('session.register');
    }

    /**
     * Dispatch command to create User
     *
     * @param UserCreation $request
     * @return \Illuminate\View\View
     */
    public function store(UserCreation $request)
    {
        $command = new CreateUserCommand($request->all());
        $user = $this->dispatch($command);
        $this->auth->login($user);

        return redirect()->route('home');
    }

    /**
     * Update User Profile.
     *
     * @param UserEdition $request
     * @return \Illuminate\Http\Response
     */
    public function update(UserEdition $request)
    {
        $command = new UpdateUserCommand($request->user(), $request->all());
        $this->dispatch($command);
        return redirect()->back();
    }

}
