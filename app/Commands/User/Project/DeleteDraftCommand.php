<?php

namespace DreamsArk\Commands\User\Project;

use DreamsArk\Commands\Command;
use DreamsArk\Models\Project\Draft;
use DreamsArk\Repositories\Project\ProjectRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;

class DeleteDraftCommand extends Command implements SelfHandling
{
    /**
     * @var Draft
     */
    private $draft;

    /**
     * Create a new command instance.
     *
     * @param Draft $draft
     */
    public function __construct(Draft $draft)
    {
        $this->draft = $draft;
    }

    /**
     * Execute the command.
     *
     * @param ProjectRepositoryInterface $repository
     */
    public function handle(ProjectRepositoryInterface $repository)
    {
        /**
         * Delete Draft
         */
        $repository->draft($this->draft->id)->delete();
    }
}
