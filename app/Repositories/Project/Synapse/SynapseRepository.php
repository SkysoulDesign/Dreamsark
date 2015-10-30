<?php

namespace DreamsArk\Repositories\Project\Synapse;

use DreamsArk\Models\Project\Stages\Draft;
use DreamsArk\Models\Project\Submission;
use DreamsArk\Models\Project\Stages\Synapse;
use DreamsArk\Repositories\RepositoryHelperTrait;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class SynapseRepository implements SynapseRepositoryInterface
{

    use RepositoryHelperTrait;

    /**
     * @var Synapse
     */
    public $model;

    /**
     * @var Submission
     */
    private $submission;

    /**
     * @param Synapse $synapse
     * @param Submission $submission
     */
    function __construct(Synapse $synapse, Submission $submission)
    {
        $this->model = $synapse;
        $this->submission = $submission;
    }

    /**
     * Get all Model from the DB
     *
     * @param array $columns
     * @return mixed
     */
    public function all(array $columns = ['*'])
    {
        return $this->model->all($columns);
    }

    /**
     * Create a Synapse
     *
     * @param int $project_id
     * @param array $fields
     * @return Synapse
     */
    public function create($project_id, array $fields)
    {
        $synapse = $this->model->setAttribute('project_id', $project_id)->fill($fields);
        $synapse->save();
        return $synapse;
    }

    /**
     * Submit Synapse
     *
     * @param int $synapse_id
     * @param int $user_id
     * @param array $fields
     * @return Submission
     */
    public function submit($synapse_id, $user_id, array $fields)
    {
        /** Todo: Find a way to not massassign the user ID */

        /** @var MorphMany $submission */
        $submission = $this->model($synapse_id)->submissions();

        return $submission->create(array_merge($fields, compact('user_id')));

    }

    /**
     * Vote on a Submission
     *
     * @param int $submission_id
     * @param int $user_id
     */
    public function vote($submission_id, $user_id)
    {
        $this->submission->find($submission_id)->attach($user_id);
    }

    /**
     * Fail an Synapse
     *
     * @param int $synapse_id
     * @return bool
     */
    public function fail($synapse_id)
    {
        return $this->model($synapse_id)->setAttribute('active', false)->save();
    }

    /**
     * Submit Synapse
     *
     * @param int $synapse_id
     * @param int $submission_id
     */
    public function createWinner($synapse_id, $submission_id)
    {
        return $this->model($synapse_id)->winners()->attach($submission_id);
    }

    /**
     * Set Model to Draft
     *
     * @param null|\DreamsArk\Models\Project\Stages\Draft $draft_id
     * @return $this
     */
    public function draft($draft_id = null)
    {
        return $this->newInstance($draft_id, Draft::class);
    }

}