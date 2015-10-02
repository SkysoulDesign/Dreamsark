<?php

namespace DreamsArk\Repositories\Translation;

use DreamsArk\Models\Translation;
use Illuminate\Support\Collection;

interface TranslationRepositoryInterface
{
    /**
     * Create a new User on the Database
     *
     * @param array $fields
     * @return Translation
     */
    public function create(array $fields);

    /**
     * Get all Model from the DB
     *
     * @param array $columns
     * @return mixed
     */
    public function all(array $columns = ['*']);

    /**
     * Update Model
     *
     * @param Int $id
     * @param array $fields
     * @return mixed|bool
     */
    public function update($id, array $fields);

    /**
     * Return all object within the where conditions
     * Best Usage with compact('value1', 'value2')
     *
     * @param $args
     * @return Collection|mixed
     */
    public function where($args);

    /**
     * Retrieve a list with all Languages
     *
     * @return Collection
     */
    public function allLanguage();

    /**
     * Retrieve a list with all Groups
     *
     * @return Collection
     */
    public function allGroup();


}