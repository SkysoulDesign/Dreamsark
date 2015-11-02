<?php

use DreamsArk\Commands\Position\CreateExpenditurePositionCommand;
use DreamsArk\Commands\Position\CreateExpenditureTypeCommand;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Bus\DispatchesJobs;

class PositionTableSeeder extends Seeder
{

    use DispatchesJobs;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = collect(['cast', 'crew', 'expense']);
        $positions = collect(array(
            'Actor'       => 1,
            'Actress'     => 1,
            'Director'    => 2,
            'Camera Man'  => 2,
            'Location'    => 3,
            'Food'        => 3,
            'Electricity' => 3,
        ));

        /**
         * Create Types
         */
        $types->each(function ($name) {
            $this->dispatch(new CreateExpenditureTypeCommand($name));
        });

        /**
         * Create Position
         */
        $positions->each(function ($type, $name) {
            $this->dispatch(new CreateExpenditurePositionCommand($name, $type));
        });

    }
}
