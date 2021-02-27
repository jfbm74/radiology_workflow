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

        $billdet = new BillDetail;

        $billdet->ordinal = "1";
        $billdet->codprod = "F5";
        $billdet->desprod = "FOTOGRAFIA X 8 FOTOS";
        $billdet->quanty = "1";
        $billdet->admission_id = "1";
        $billdet->quanty = "1";
        $billdet->save();

        $billdet = new BillDetail;

        $billdet->ordinal = "2";
        $billdet->codprod = "RPE";
        $billdet->desprod = "RX PERFIL";
        $billdet->quanty = "1";
        $billdet->admission_id = "1";
        $billdet->quanty = "1";
        $billdet->save();
            
    }
}
