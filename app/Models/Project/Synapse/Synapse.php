<?php

namespace DreamsArk\Models\Project\Synapse;

use DreamsArk\Models\Project\Submission;
use DreamsArk\Models\Project\Project;
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
     * Audition Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function audition()
    {
        return $this->project->audition();
    }

    /**
     * Submission Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function submissions()
    {
        return $this->morphToMany(Synapse::class, 'submissionable', 'submissions');
    }
}
