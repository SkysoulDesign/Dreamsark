<?php

namespace DreamsArk\Models\Project;

use Illuminate\Database\Eloquent\Model;

class Script extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'scripts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [''];

    /**
     * Take Relationship
     */
    public function takes()
    {
        return $this->hasMany(Take::class);
    }
}
