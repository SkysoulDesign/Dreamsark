<?php

namespace DreamsArk\Models\Project\Stages;

use DreamsArk\Models\Project\Project;
use DreamsArk\Models\Traits\ProjectableTrait;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use ProjectableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'funds';

    /**
     * Define Which is the next Model
     */
    protected $next = Synapse::class;

    /**
     * Project Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
