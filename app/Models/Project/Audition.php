<?php

namespace DreamsArk\Models\Project;

use Illuminate\Database\Eloquent\Model;

class Audition extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'auditions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * Project Relationship
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
