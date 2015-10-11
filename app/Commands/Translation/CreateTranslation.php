<?php

namespace DreamsArk\Commands\Translation;

use DreamsArk\Commands\Command;
use DreamsArk\Models\Translation\Group;
use DreamsArk\Models\Translation\Language;
use DreamsArk\Repositories\Translation\TranslationRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;

class CreateTranslation extends Command implements SelfHandling
{
    /**
     * @var string
     */
    private $group;

    /**
     * @var array
     */
    private $translation;

    /**
     * @var string
     */
    private $language;

    /**
     * Create a new command instance.
     *
     * @param Language $language
     * @param Group $group
     * @param array $translation
     */
    public function __construct(Language $language, Group $group, array $translation)
    {
        $this->translation = $translation;
        $this->group = $group;
        $this->language = $language;
    }

    /**
     * Execute the command.
     *
     * @param TranslationRepositoryInterface $repository
     * @return Language
     */
    public function handle(TranslationRepositoryInterface $repository)
    {
        return $repository->createTranslation($this->language->id, $this->group->id, $this->translation);
    }

}
