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
    public function backers()
    {
        return $this->belongsToMany(User::class, 'expenditure_backer')->withPivot('amount');
    }

}
