<?php

namespace DreamsArk\Models\Project;

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
    protected $fillable = [];

    /**
     * Presenter for this class
     *
     * @var Presenter
     */
    protected $presenter = ProjectPresenter::class;

    /**
     * User Relationship
     */
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Alias to User Relationship
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * User Relationship
     */
    public function backers()
    {
        return $this->belongsToMany(User::class, 'project_backers')->withPivot('amount');
    }

    /**
     * Script Relationship
     */
    public function script()
    {
        return $this->hasOne(Script::class);
    }

    /**
     * Cast Relationship
     */
    public function cast()
    {
        return $this->hasMany(Cast::class);
    }

    /**
     * Crew Relationship
     */
    public function crew()
    {
        return $this->hasMany(Crew::class);
    }

    /**
     * Crew Relationship
     */
    public function characters()
    {
        return $this->belongsToMany(User::class, 'project_character');
    }

    /**
     * Audition Relationship
     */
    public function audition()
    {
        return $this->hasOne(Audition::class);
    }

}
