<?php

namespace DreamsArk\Models\Project;

use DreamsArk\Models\Project\Idea\Idea;
use DreamsArk\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'submissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content', 'visibility'];

    /**
     * User Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Idea Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function idea()
    {
        return $this->belongsTo(Idea::class);
    }

    /**
     * Vote Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes()
    {
        return $this->belongsToMany(User::class, 'submission_vote')->withPivot('amount');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function stageble()
    {
        return $this->morphTo();
    }

}
