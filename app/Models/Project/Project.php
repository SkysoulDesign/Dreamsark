<?php

namespace DreamsArk\Models\Project;

use DreamsArk\Models\Project\Idea\Idea;
use DreamsArk\Models\Project\Script\Script;
use DreamsArk\Models\Project\Synapse\Synapse;
use DreamsArk\Models\User\User;
use DreamsArk\Presenters\PresentableTrait;
use DreamsArk\Presenters\Presenter;
use DreamsArk\Presenters\Presenter\ProjectPresenter;
use DreamsArk\Repositories\Project\ProjectRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use PresentableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'projects';

    /**
     * Define this model Repository.
     *
     * @var string
     */
    public $repository = ProjectRepositoryInterface::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Presenter for this class
     *
     * @var Presenter
     */
    protected $presenter = ProjectPresenter::class;

    /**
     * Scope a query to only show active entries.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Scope a query to only show failed entries.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFailed($query)
    {
        return $query->where('active', false);
    }

    /**
     * User Relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns the right Relationship for the current project stage
     */
    public function stage()
    {
        return $this->{$this->type}();
    }

    /**
     * Idea Relationship
     */
    public function idea()
    {
        return $this->hasOne(Idea::class);
    }

    /**
     * Synapse Relationship
     */
    public function synapse()
    {
        return $this->hasOne(Synapse::class);
    }

    /**
     * Script Relationship
     */
    public function script()
    {
        return $this->hasOne(Script::class);
    }

    /**
     * Audition Relationship
     */
    public function audition()
    {
        return $this->hasOne(Audition::class);
    }

}
