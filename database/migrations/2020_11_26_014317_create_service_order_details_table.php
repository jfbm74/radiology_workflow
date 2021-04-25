<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('service_order_id');
            $table->integer('ordinal');
            $table->unsignedBigInteger('product_id')->nullable();
//            $table->string('name');
            $table->string('status')->nullable();
            $table->dateTime('fullfilment_date')->nullable();
            $table->float('kv')->nullable();
            $table->float('ma')->nullable();
            $table->float('dosis')->nullable();
            $table->float('extime')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
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
        Schema::dropIfExists('service_order_details');
    }
}
