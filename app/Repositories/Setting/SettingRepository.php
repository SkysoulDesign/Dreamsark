<?php

namespace DreamsArk\Repositories\Setting;

use DreamsArk\Models\Setting;
use DreamsArk\Models\User;
use DreamsArk\Repositories\Repository;

class SettingRepository extends Repository implements SettingRepositoryInterface
{
    /**
     * @var Setting
     */
    public $model;

    /**
     * @param Setting $setting
     */
    function __construct(Setting $setting)
    {
        $this->model = $setting;
    }

    /**
     * Create a new User on the Database
     *
     * @param Int $user_id
     * @param array $fields
     * @return User
     */
    public function create($user_id, array $fields)
    {
        $fields = collect($fields)->merge(compact('user_id'));
        $this->model->create($fields->toArray());
    }

    /**
     * Create a new setting with default values
     *
     * @param Int $user_id
     * @return Setting
     */
    public function createDefault($user_id)
    {
        return $this->create($user_id, config('defaults.settings'));
    }

}