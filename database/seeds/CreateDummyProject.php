<?php

use DreamsArk\Commands\Project\CreateProjectCommand;
use DreamsArk\Commands\Project\Stages\Voting\CloseVotingCommand;
use DreamsArk\Commands\Project\Stages\Voting\OpenVotingCommand;
use DreamsArk\Commands\Project\Submission\SubmitCommand;
use DreamsArk\Commands\Project\Submission\VoteOnSubmissionCommand;
use DreamsArk\Models\Project\Project;
use DreamsArk\Models\Project\Stages\Vote;
use DreamsArk\Models\Project\Submission;
use DreamsArk\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Bus\DispatchesJobs;

class CreateDummyProject extends Seeder
{

    use DispatchesJobs;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * Create Project
         */
        $user = User::find(2);
        $fields = array(
            'type'    => 'script',
            'name'    => 'My Supper Project',
            'content' => 'This is a Script',
            'reward'  => '5'
        );

        $this->dispatch(new CreateProjectCommand($user, $fields));

        /**
         * Submit To Project
         */
        $project = Project::first();
        $fields = array(
            'content'    => 'Dummy Submisttion',
            'visibility' => '1'
        );

        collect(range(1, 10))->each(function () use ($project, $user, $fields) {
            $this->dispatch(new SubmitCommand($project, $user, $fields));
        });

        /**
         * Open project Voting
         */
        $vote = Vote::first();
        $this->dispatch(new OpenVotingCommand($vote));

        /**
         * Vote on Some Submissions
         */
        $submissions = Submission::all();

        collect(range(1, 10))->each(function () use ($submissions, $user) {
            $this->dispatch(new VoteOnSubmissionCommand(rand(1, 50), $submissions->random(), $user));
        });

        /**
         * Close the Voting
         */
        $this->dispatch(new CloseVotingCommand($vote));

    }
}
