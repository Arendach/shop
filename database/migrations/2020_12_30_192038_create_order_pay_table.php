<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_pay', function (Blueprint $table) {
            $table->id();
            $table->string('action')->default('pay');
            $table->integer('order_id');
            $table->double('amount');
            $table->string('currency');
            $table->string('description')->default('Комментарий не указан');
            $table->string('create_date')->nullable();
            $table->string('err_code')->nullable();
            $table->integer('payment_id');
            $table->string('paytype');
            $table->string('sender_card_bank');
            $table->string('sender_card_mask2');
            $table->string('sender_first_name');
            $table->string('sender_last_name');
            $table->string('sender_phone');
            $table->string('status');

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
        Schema::dropIfExists('order_pay');
    }
}
