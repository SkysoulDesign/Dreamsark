<?php

use DreamsArk\Commands\Session\CreateUserCommand;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Bus\DispatchesJobs;

class UserTableSeeder extends Seeder
{

    use DispatchesJobs;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'first_name' => 'Rafael',
            'last_name' => 'Milewski',
            'gender' => 'male',
            'password' => "478135",
            'email' => 'rafael.milewski@gmail.com'
        ];

        $this->dispatch(new CreateUserCommand($admin));

    }

}
