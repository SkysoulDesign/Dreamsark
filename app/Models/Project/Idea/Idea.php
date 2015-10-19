<?php

namespace DreamsArk\Models\Project\Idea;

use DreamsArk\Models\Project\Project;
use DreamsArk\Models\User\User;
use DreamsArk\Presenters\PresentableTrait;
use DreamsArk\Presenters\Presenter;
use DreamsArk\Presenters\Presenter\IdeaPresenter;
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
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
