<?php

use App\Patient;
use Illuminate\Database\Seeder;


class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Patient::truncate();

        $patient = new Patient;
        
        $patient->name = "MARMOLEJO GOMEZ VALENTINA";
        $patient->legal_id = "1144092280";
        $patient->birthday = "1997-09-23";   
        $patient->save();
    }
}
