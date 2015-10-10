<?php

namespace DreamsArk\Repositories\Bag;

use DreamsArk\Models\Bag;

interface BagRepositoryInterface
{
    /**
     * Create a new Bag on the Database
     *
     * @param array $fields
     * @return Bag
     */
    public function create(array $fields);

    /**
     * Create a new Project on the Database
     *
     * @param array $fields
     * @param int $user_id
     * @return Bag
     */
    public function attach(array $fields, $user_id);

    /**
     * Increment user coins amount
     *
     * @param $bag_id
     * @param int $amount
     * @return void
     */
    public function addCoins($bag_id, $amount);

}