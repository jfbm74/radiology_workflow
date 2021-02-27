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

        $stat = new StatisticAdmission;

        $stat->admission_id = '1';
        $stat->admission_date = '2021-02-26 19:06:02';
        $stat->waiting_time = '13';
        $stat->attention_time = '13';
        $stat->finish_time = '20';
        $stat->user_id = '1';
        $stat->professional_id = '369';
        $stat->save();

    }
}
