<?php

namespace DreamsArk\Models\Idea;

use DreamsArk\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'submissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['description'];

    /**
     * User Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
