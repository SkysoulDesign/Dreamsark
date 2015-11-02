<?php

namespace DreamsArk\Models\Project\Expenditures;

use DreamsArk\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'expenditure_casts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'cost', 'description'];

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
        return $this->belongsTo(Position::class, 'expenditure_position_id');
    }

}
