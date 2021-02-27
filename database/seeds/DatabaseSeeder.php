<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PackageSeeder::class);
        $this->call(PackageDetailSeeder::class);
        $this->call(PatientSeeder::class);
        $this->call(AdmissionSeeder::class);
        $this->call(BillDetailsSeeder::class);
        $this->call(ServiceOrderSeeder::class);
        $this->call(ServiceOrderDetailSeeder::class);
        $this->call(PrintingSeeder::class);
        $this->call(StatisticAdmissionSeeder::class);        
    }
}
