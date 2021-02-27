<?php

use Illuminate\Database\Seeder;
use App\ServiceOrder;

class ServiceOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceOrder::truncate();

        $os = new ServiceOrder;

        $os->admission_id = '1';
        $os->user_id = '1';
        $os->is_active = '1';
        $os->save();

    }
}
