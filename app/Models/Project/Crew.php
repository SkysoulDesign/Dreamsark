<?php

namespace DreamsArk\Models\Project;

use DreamsArk\Models\User;
use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'crew';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'role', 'description'];

    /**
     * Candidates Relationship
     */
    public function candidates()
    {
        return $this->belongsToMany(User::class, 'crew_candidate');
    }
}
