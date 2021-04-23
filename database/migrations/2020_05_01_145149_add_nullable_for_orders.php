<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddNullableForOrders extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->text('comment')->nullable()->change();
            $table->decimal('delivery_costs', 11, 2)->nullable()->change();
            $table->decimal('discount', 11, 2)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->text('comment')->nullable()->change();
            $table->decimal('delivery_costs', 11, 2)->nullable()->change();
            $table->decimal('discount', 11, 2)->nullable()->change();
        });
    }
}
