<?php

use Illuminate\Database\Seeder;
use App\BillDetail;

class BillDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BillDetail::truncate();
    }
}
