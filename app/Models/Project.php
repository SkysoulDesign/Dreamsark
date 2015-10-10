<?php

namespace DreamsArk\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
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
    protected $fillable = ['title', 'description', 'budget'];

    /**
     * User Relationship
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
        return $this->belongsToMany(User::class, 'project_backers');
    }
}
