<?php

namespace DreamsArk\Models\Project;

use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'casts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'salary', 'description'];

    /**
     * Expenditure Relationship
     */
    public function expenditure()
    {
        return $this->morphMany(Expenditure::class, 'expenditurable');
    }

    /**
     * Cast Relationship
     */
    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
