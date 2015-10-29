<?php

namespace DreamsArk\Presenters\Presenter;

use DreamsArk\Presenters\Presenter;

class ProjectPresenter extends Presenter
{

    /**
     * Return project completion
     *
     * @return string
     */
    public function progress()
    {
        return round(($this->backers->sum('pivot.amount') * 100) / $this->budget);
    }

}