<?php

namespace DreamsArk\Commands\Project\Audition;

use DreamsArk\Commands\Command;
use DreamsArk\Models\Project\Audition;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Queue\SerializesModels;

class OpenAuditionCommand extends Command implements SelfHandling
{
    use SerializesModels;

    /**
     * @var Audition
     */
    private $audition;

    /**
     * Create a new command instance.
     *
     * @param Audition $audition
     */
    public function __construct(Audition $audition)
    {
        $this->audition = $audition;
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {

    }

}
