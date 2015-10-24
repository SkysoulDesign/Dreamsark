<?php

namespace DreamsArk\Models\Project;

use DreamsArk\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Draft extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'project_draft';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'reward', 'content', 'vote_date'];

    /**
     * User Relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
