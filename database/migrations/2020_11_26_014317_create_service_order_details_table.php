<?php$table->string('cod_manager');

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
            $table->string('cod_manager')->nullable();
            $table->string('name');
            $table->string('status')->nullable();
            $table->dateTime('fullfilment_date')->nullable();
            $table->integer('exposure_time')->nullable();
            $table->integer('ionizing_radiation_dose')->nullable();
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
