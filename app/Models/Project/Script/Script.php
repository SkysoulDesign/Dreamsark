<?php

namespace DreamsArk\Models\Project\Script;

use DreamsArk\Models\Project\Idea\Idea;
use DreamsArk\Models\Project\Submission;
use DreamsArk\Models\Project\Project;
use DreamsArk\Models\Project\VotableTrait;
use DreamsArk\Models\Project\Vote;
use DreamsArk\Repositories\Project\Script\ScriptRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Script extends Model
{
    use VotableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'scripts';

    /**
     * Define this model Repository.
     *
     * @var string
     */
    public $repository = ScriptRepositoryInterface::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content', 'reward'];

    /**
     * Define Which is the next Model
     */
    protected $next = Project::class;

    /**
     * Scope a query to only show visible entries.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublic($query)
    {
        return $query->where('visibility', true);
    }

    /**
     * Scope a query to only show private entries.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePrivate($query)
    {
        return $query->where('visibility', false);
    }

    /**
     * Project Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Submission Relationship
     * Only Available once there is a winner for this project
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function submission()
    {
        return $this->belongsto(Submission::class);
    }

    /**
     * Submission Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function submissions()
    {
        return $this->morphMany(Submission::class, 'submissible');
    }

    /**
     * User Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->project->user();
    }

}
