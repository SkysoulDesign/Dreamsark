<?php

namespace DreamsArk\Models\Project\Stages;

use DreamsArk\Models\Project\Cast;
use DreamsArk\Models\Project\Project;
use DreamsArk\Models\Traits\ProjectableTrait;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    use ProjectableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reviews';

    /**
     * Project Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project(){
        return $this->belongsTo(Project::class);
    }

}
