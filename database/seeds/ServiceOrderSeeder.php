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


    }
}
