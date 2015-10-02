<?php

namespace DreamsArk\Repositories\Translation;

use DreamsArk\Models\Translation;
use DreamsArk\Repositories\Repository;
use Illuminate\Support\Collection;
use ReflectionParameter;

class TranslationRepository extends Repository implements TranslationRepositoryInterface
{

    /**
     * @var Translation
     */
    public $model;

    /**
     * @param Translation $translation
     */
    function __construct(Translation $translation)
    {
        $this->model = $translation;
    }

    /**
     * Retrieve a list with all Languages
     *
     * @return Collection
     */
    public function allLanguage()
    {
        return $this->all(['language'])->unique('language')->lists('language', 'language');
    }

    /**
     * Retrieve a list with all Groups
     *
     * @return Collection
     */
    public function allGroup()
    {
        return $this->all(['group'])->unique('group')->lists('group', 'group');
    }



}