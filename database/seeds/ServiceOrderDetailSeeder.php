<?php

use App\ServiceOrderDetail;
use Illuminate\Database\Seeder;

class ServiceOrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceOrderDetail::truncate();

    }
}
