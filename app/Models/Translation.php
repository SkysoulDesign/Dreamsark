<?php

namespace DreamsArk\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'translations';

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql-translation';

    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
