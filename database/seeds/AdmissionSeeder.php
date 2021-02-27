<?php

use App\Admission;
use Illuminate\Database\Seeder;

class AdmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admission::truncate();

        $admission = new Admission;
        $admission->id = "1";
        $admission->invoice_number = 5999;
        $admission->doctype = "FV00";
        $admission->invoice_date = "2021-02-26 19:06:02";
        $admission->calling_date = "2021-02-26 19:19:36";
        $admission->finish_date = "2021-02-26 19:23:33";
        $admission->status = "Finalizado";
        $admission->priority = "5";
        $admission->delivery = "Acetato";
        $admission->obs = "Seed registry";
        $admission->patient_id = "1";
        $admission->user_id = "1";

        $admission->save();

    }
}
