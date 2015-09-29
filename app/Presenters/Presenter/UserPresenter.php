<?php

namespace DreamsArk\Presenters\Presenter;

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
        return $this->model->avatar ?: asset('img/avatar/' . $this->model->gender . '.png');
    }

}