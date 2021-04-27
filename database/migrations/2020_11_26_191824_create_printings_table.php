<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_order_details_id');
            $table->smallInteger('ordinal');
            $table->string('type');
            $table->smallInteger('quanty')->default(0);
            $table->smallInteger('printed')->default(0);
            $table->smallInteger('repeated')->default(0);
            $table->string('printer')->nullable();
            $table->boolean('is_printed')->default(0);
            $table->dateTime('printed_date')->nullable();
            $table->unsignedBigInteger('user_id')->default(11)->nullable();
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
        Schema::dropIfExists('printings');
    }
}
