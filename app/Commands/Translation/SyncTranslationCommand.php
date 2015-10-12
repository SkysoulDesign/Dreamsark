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
        /** @var Collection $translations */
        $translations = $repository->all()->load('language', 'groups');

        $languages = $translations->groupBy('language.name');

        $chinese = $languages->get('cn');
        $english = $languages->get('en');

        dd('under test please dont use it yet');

        $english->merge($english)->diff($english)->map(function ($translation) {

            $translation->groups->map(function ($group) use ($translation) {
                $this->dispatch(new CreateTranslation('1', $group->id, array_only($translation->toArray(), ['key', 'value'])));
            });

        });

    }
}
