<?php

namespace DreamsArk\Commands\Translation;

use DreamsArk\Commands\Command;
use DreamsArk\Models\Translation;
use DreamsArk\Repositories\Translation\TranslationRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Translation\Translator;

class ImportTranslationCommand extends Command implements SelfHandling
{

    use DispatchesJobs;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the command.
     *
     * @param Filesystem $fileSystem
     * @param Application $app
     * @param Translator $translator
     */
    public function handle(Filesystem $fileSystem, Application $app, Translator $translator)
    {
        $files = $fileSystem->allFiles($app->langPath());
        $loader = $translator->getLoader();

        foreach ($files as $file) {

            $language = $file->getRelativePath();
            $group = collect(pathinfo($file))->get('filename');

            $translations = collect($loader->load($language, $group));

            /**
             * Remove Arrays At this moment
             */
            $translations->transform(function ($value) {
                if (is_array($value)) return 'Array not Supported';
                return $value;
            });

            /**
             * Insert into the Database hackie
             */
            $translations->map(function ($value, $key) use ($language, $group) {
                return Translation::firstOrCreate(compact('value', 'key', 'group', 'language'));
            });

            /**
             * Insert into the Database
             */
//            $command = new CreateNewTranslation($language, $group, $translations->toArray());
//            $this->dispatch($command);

        }

    }
}
