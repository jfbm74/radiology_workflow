<?php

use Illuminate\Database\Seeder;
use App\StatisticAdmission;

class StatisticAdmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatisticAdmission::truncate();

    }
}
