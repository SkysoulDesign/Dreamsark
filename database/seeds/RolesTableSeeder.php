<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'name' => 'Admin',
            'email' => 'rafael.milewski@gmail.com'
        ];

        $user = $this->dispatch(new CreateUserCommand($rafael));
        $this->dispatch(new PurchaseCoinCommand($user, 50 ));
    }
}
