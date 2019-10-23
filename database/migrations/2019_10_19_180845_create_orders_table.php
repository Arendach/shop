<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 64)->nullable();
            $table->string('phone', 32)->nullable();
            $table->string('email', 32)->nullable();

            $table->string('delivery', 32)->nullable()->default('delivery');
            $table->text('comment')->nullable();

            $table->string('pay_method')->default('cash')->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('status', 32)->default('new_order')->nullable();

            $table->dateTime('date_delivery')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->integer('base_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
