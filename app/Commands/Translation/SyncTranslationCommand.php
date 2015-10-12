<?php

namespace DreamsArk\Commands\Translation;

use DreamsArk\Commands\Command;
use DreamsArk\Repositories\Translation\TranslationRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Collection;

class SyncTranslationCommand extends Command implements SelfHandling
{

    use DispatchesJobs;

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
    }

    /**
     * Execute the command.
     *
     * @param TranslationRepositoryInterface $repository
     */
    public function handle(TranslationRepositoryInterface $repository)
    {
        /**
         * Grab All Translations for futher use
         */
        $translations = $repository->all()->load('language', 'groups');

        /**
         * Get All Groups
         */
        $groups = $repository->groups()->load('translations', 'translations.language');

        /**
         * For Each Group Execute Operation
         */
        $groups->map(function ($group) {

            /**
             * Get All Languages Contained within this Group
             */
            $languages = $group->translations->groupBy('language.id');

            /**
             * Merge All Values in order to get uniques
             */
            $merged = $languages->map(function ($language) {
                return $language->pluck('value', 'key');
            })->collapse();

            /**
             * Now for each language extract the merged groups in order to get new keys
             */
            $languages->each(function ($translations, $language) use ($merged, $group) {

                $newValues = collect($merged)->diff($translations->pluck('value', 'key'));

                /**
                 * For each new Value, Create a new Translation
                 */
                $newValues->each(function ($value, $key) use ($language, $group) {
                    $this->dispatch(new CreateTranslationCommand($language, $group->id, compact('key')));
                });

            });

        });

    }
}
