<?php

use Illuminate\Database\Seeder;
use App\Printing;

class PrintingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Printing::truncate();


    }
}
