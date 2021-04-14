<?php

use Illuminate\Database\Seeder;
use App\Supply;

class SupplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supply::truncate();

        $supply = new Supply;
        $supply->type = 'Acetato';
        $supply->quanty = '100';
        $supply->remain = '100';
        $supply->start_date = now();

        $supply->save();

    }
}
