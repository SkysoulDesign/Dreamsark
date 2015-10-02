<?php

namespace DreamsArk\Commands\Translation;

use DreamsArk\Commands\Command;
use DreamsArk\Repositories\Translation\TranslationRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;

class ExportTranslationCommand extends Command implements SelfHandling
{
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
     * @param TranslationRepositoryInterface $repository
     * @param Filesystem $fileSystem
     * @param Application $app
     */
    public function handle(TranslationRepositoryInterface $repository, Filesystem $fileSystem, Application $app)
    {
        /** @var Collection $translations */
        $translations = $repository->all();

//        $translations->groupBy('language')->map(function ($key) {
//            return $key->groupBy('group');
//        });

        foreach ($translations->groupBy('language') as $language => $translation) {

            foreach ($translation->groupBy('group') as $group => $final) {
                $content = $final->lists('value', 'key')->toArray();

                $output = "<?php\n\nreturn " . var_export($content, true) . ";\n";
                $path = $app->langPath() . '/' . $language . '/' . $group . '.php';

                if (!$fileSystem->exists($path)) {
                    $fileSystem->makeDirectory($app->langPath() . '/' . $language);
                }

                $fileSystem->put($path, $output);

            }

        }

    }
}
