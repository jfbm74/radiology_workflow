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

        $det = new ServiceOrderDetail;

        $det->service_order_id = '1';
        $det->ordinal = '1';
        $det->product_id = '12';
        $det->status= 'cumplido';
        $det->fullfilment_date = '2021-02-26 19:23:27';
        $det->user_id = '1';
        $det->save();

        $det = new ServiceOrderDetail;

        $det->service_order_id = '1';
        $det->ordinal = '2';
        $det->product_id = '58';
        $det->status= 'cumplido';
        $det->fullfilment_date = '2021-02-26 19:23:33';
        $det->user_id = '1';
        $det->save();

    }
}
