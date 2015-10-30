<?php

namespace DreamsArk\Models\Project;

use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'expenditures';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Project Relationship
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Polymorphic Relations
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function expenditurable()
    {
        return $this->morphTo();
    }

    /**
     * Polymorphic Relations
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function cast()
    {
        return $this->belongsTo(Cast::class);
    }

}
