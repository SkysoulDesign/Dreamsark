<?php

namespace DreamsArk\Models\Project;

use Illuminate\Database\Eloquent\Model;

class Take extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'takes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'length', 'location', 'shot', 'description'];
}
