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

        $print = new Printing;

        $print->service_order_details_id = '1';
        $print->ordinal = '2';
        $print->type = 'Acetato';
        $print->quanty = '1';
        $print->printed = '1';
        $print->repeated = '0';
        $print->is_printed = '1';
        $print->printed_date = '2021-02-26 19:26:19';
        $print->user_id = '1';
        $print->save();


        $print = new Printing;

        $print->service_order_details_id = '2';
        $print->ordinal = '10';
        $print->type = 'Acetato';
        $print->quanty = '1';
        $print->printed = '1';
        $print->repeated = '0';
        $print->is_printed = '1';
        $print->printed_date = '2021-02-26 19:26:21';
        $print->user_id = '1';
        $print->save();

    }
}
