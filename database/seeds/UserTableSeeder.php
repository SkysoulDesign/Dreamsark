<?php

use DreamsArk\Commands\Bag\PurchaseCoinCommand;
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
        $rafael = [
            'first_name' => 'Rafael',
            'last_name' => 'Milewski',
            'gender' => 'male',
            'birthday' => '1992-12-31',
            'password' => "478135",
            'email' => 'rafael.milewski@gmail.com'
        ];

        $user = $this->dispatch(new CreateUserCommand($rafael));
        $this->dispatch(new PurchaseCoinCommand($user, 999999 ));

        $dreamsark = [
            'first_name' => 'Dreams',
            'last_name' => 'Ark',
            'gender' => 'male',
            'birthday' => '1980-01-01',
            'password' => "dreamsark",
            'email' => 'dreamsark@dreamsark.com'
        ];

        $this->dispatch(new CreateUserCommand($dreamsark));

        $justin = [
            'first_name' => 'Justin',
            'last_name' => 'Kuo',
            'gender' => 'male',
            'birthday' => '1980-01-01',
            'password' => "skysoul",
            'email' => 'skysoul@skysoul.com.au'
        ];

        $this->dispatch(new CreateUserCommand($justin));

    }

}
