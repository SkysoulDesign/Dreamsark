<?php

namespace DreamsArk\Models\Project;

use DreamsArk\Models\Project\Idea\Idea;
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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['open_date', 'close_date'];

    /**
     * Project Relationship
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
