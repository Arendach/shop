<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderSendingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_sending', function (Blueprint $table) {
            $table->increments('id');

            $table->string('city_key', 64)->nullable();
            $table->string('city_name_uk', 128)->nullable();
            $table->string('city_name_ru', 128)->nullable();

            $table->string('warehouse_key', 64)->nullable();
            $table->string('warehouse_name_uk', 128)->nullable();
            $table->string('warehouse_name_ru', 128)->nullable();

            $table->integer('order_id')->unsigned();

            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_sending');
    }
}
