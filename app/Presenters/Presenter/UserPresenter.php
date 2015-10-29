<?php

namespace DreamsArk\Presenters\Presenter;

use Carbon\Carbon;
use DreamsArk\Presenters\Presenter;

class UserPresenter extends Presenter
{

    /**
     * Compose the user name
     *
     * @return string
     */
    public function name()
    {
        return $this->model->first_name . " " . $this->model->last_name;
    }

    /**
     * Display the user Avatar
     *
     * @return string
     */
    public function avatar()
    {
        return asset('img/avatar/' . $this->model->gender . '.png');
    }

    /**
     * Return User Age
     *
     * @return string
     */
    public function age()
    {
        return Carbon::parse($this->model->birthday)->age;
    }

}