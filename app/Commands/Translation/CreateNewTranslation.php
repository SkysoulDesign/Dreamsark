<?php

namespace DreamsArk\Commands\Translation;

use DreamsArk\Commands\Command;
use DreamsArk\Models\Translation;
use DreamsArk\Repositories\Translation\TranslationRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;

class CreateNewTranslation extends Command implements SelfHandling
{
    /**
     * @var string
     */

    private $group;

    /**
     * @var array
     */
    private $translations;

    /**
     * @var string
     */
    private $language;

    /**
     * Create a new command instance.
     *
     * @param $language
     * @param $group
     * @param array $translations
     */
    public function __construct($language, $group, array $translations)
    {
        $this->group = $group;
        $this->translations = collect($translations);
        $this->language = $language;
    }

    /**
     * Execute the command.
     *
     * @param TranslationRepositoryInterface $repository
     */
    public function handle(TranslationRepositoryInterface $repository)
    {

        $this->translations->each(function ($value, $key) use ($repository) {
            $repository->create($this->getData($key, $value));
        });

    }

    /**
     * Populate Array for creation
     *
     * @param $key
     * @param $value
     * @return array
     */
    private function getData($key, $value)
    {
        return [
            'key' => $key,
            'value' => $value,
            'group' => $this->group,
            'language' => $this->language
        ];
    }

}
