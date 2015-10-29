<?php

namespace DreamsArk\Models\Project\Synapse;

use DreamsArk\Models\Project\Script\Script;
use DreamsArk\Models\Project\Submission;
use DreamsArk\Models\Project\Project;
use DreamsArk\Models\Project\Vote;
use DreamsArk\Repositories\Project\Synapse\SynapseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Synapse extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'synapses';

    /**
     * Define this model Repository.
     *
     * @var string
     */
    public $repository = SynapseRepositoryInterface::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content', 'reward'];

    /**
     * Get all of the product's photos.
     */
    public function vote()
    {
        return $this->morphOne(Vote::class, 'votable');
    }

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
     * User Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->project->user();
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
     * Define which model is the Next on its creation order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function next()
    {
        return app()->make(Script::class);
    }

}
