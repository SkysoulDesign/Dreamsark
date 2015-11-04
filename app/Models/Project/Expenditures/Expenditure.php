<?php

namespace DreamsArk\Models\Project\Expenditures;

use DreamsArk\Models\Project\Project;
use DreamsArk\Models\User\User;
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
     * Scope a query to only show active entries.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeEnrollable($query)
    {
        return $query->whereIn('expenditurable_type', array(Cast::class, Crew::class));
    }

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
     * Backers Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function enrollers()
    {
        return $this->belongsToMany(User::class, 'expenditure_enroller')->withTimestamps();
    }

}
