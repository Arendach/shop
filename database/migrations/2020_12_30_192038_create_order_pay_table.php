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
            $table->string('result')->default('ok');
            $table->string('action')->default('pay');
            $table->string('status');
            $table->string('type')->nullable();
            $table->string('paytype')->nullable();
            $table->integer('order_id');
            $table->integer('liqpay_order_id');
            $table->string('description');
            $table->string('sender_card_mask2');
            $table->string('sender_card_bank');
            $table->string('sender_card_type');
            $table->float('amount', 11, 2);
            $table->string('currency');
            $table->float('sender_commission',8,2);
            $table->float('receiver_commission',8,2);
            $table->string('create_date');
            $table->string('end_date');
            $table->string('err_code')->nullable();
            $table->string('err_description')->nullable();
            $table->integer('payment_id')->nullable();
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
