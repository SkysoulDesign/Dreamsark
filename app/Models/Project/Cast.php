<?php

namespace DreamsArk\Models\Project;

use DreamsArk\Models\User;
use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cast';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'role', 'description', 'salary'];

    /**
     * Candidates Relationship
     */
    public function candidates()
    {
        return $this->belongsToMany(User::class, 'cast_candidate');
    }
}
