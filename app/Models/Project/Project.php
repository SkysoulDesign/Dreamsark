<?php

namespace DreamsArk\Models\Project;

use DreamsArk\Models\Project\Idea\Idea;
use DreamsArk\Models\Project\Idea\Submission;
use DreamsArk\Models\User\User;
use DreamsArk\Presenters\PresentableTrait;
use DreamsArk\Presenters\Presenter;
use DreamsArk\Presenters\Presenter\ProjectPresenter;
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
     * User Relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Idea Relationship
     */
    public function idea()
    {
        return $this->hasOne(Idea::class);
    }

    /**
     * Submission Relationship
     */
    public function submissions(){
        return $this->hasManyThrough(Submission::class, Idea::class);
    }


}
