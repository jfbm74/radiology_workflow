<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistic_admissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('admission_id');
            $table->dateTime('admission_date')->nullable();
            $table->integer('waiting_time')->nullable()->comment('patinent waiting time in minutes');
            $table->integer('attention_time')->nullable()->comment('patient from billing to end attentionin minutes');
            $table->integer('finish_time')->nullable()->comment('finish time in minutes for a patient ');
            $table->unsignedInteger('user_id')->comment('staff user who call the patient ');
            $table->unsignedInteger('professional_id')->comment('professional referring the patient');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistic_admissions');
    }
}
