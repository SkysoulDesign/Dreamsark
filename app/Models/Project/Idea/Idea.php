<?php

namespace DreamsArk\Models\Project\Idea;

use DreamsArk\Models\Project\Project;
use DreamsArk\Models\Project\Submission;
use DreamsArk\Models\Project\Synapse\Synapse;
use DreamsArk\Presenters\PresentableTrait;
use DreamsArk\Presenters\Presenter;
use DreamsArk\Presenters\Presenter\IdeaPresenter;
use DreamsArk\Repositories\Project\Idea\IdeaRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{

    use PresentableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ideas';

    /**
     * Define this model Repository.
     *
     * @var string
     */
    public $repository = IdeaRepositoryInterface::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content', 'reward'];

    /**
     * Presenter for this class
     *
     * @var Presenter
     */
    protected $presenter = IdeaPresenter::class;

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
     * Submission Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function winners()
    {
        return $this->belongsToMany(Submission::class);
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
     * Audition Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function audition()
    {
        return $this->project->audition();
    }

    /**
     * Define which model is the Next on its creation order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function next()
    {
        return app()->make(Synapse::class);
    }

}
