<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('legal_id')->unique()->comment('Legal identification number');
            $table->string('phone')->nullable();
            $table->date('birthday');
            $table->string('email')->nullable();
            $table->timestamps();
        });

        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_number');
            $table->string('doctype');
            $table->string('docclase');
            $table->dateTime('invoice_date');
            $table->dateTime('calling_date')->nullable();
            $table->dateTime('attending_date')->nullable();
            $table->dateTime('finish_date')->nullable();
            $table->string('status')->default('En Espera');
            $table->unsignedSmallInteger('priority')->nullable()->default('5');
            $table->string('delivery');
            $table->string('order_printing');
            $table->text('obs')->nullable();
            $table->unsignedInteger('patient_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();

        });

        Schema::create('bill_details', function (Blueprint $table) {
            $table->id();
            $table->string('ordinal');
            $table->string('codprod');
            $table->string('desprod');
            $table->integer('quanty');
            $table->unsignedInteger('admission_id');
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
        Schema::dropIfExists('patients');
        Schema::dropIfExists('admissions');
        Schema::dropIfExists('bill_details');
    }
}
