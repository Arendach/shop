<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangeOrdersTable extends Migration
{
    public function __construct()
    {
        Schema::disableForeignKeyConstraints();
    }

    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // delivery type fields
            $table->string('city', 256)->nullable();
            $table->string('street', 256)->nullable();
            $table->string('address', 256)->nullable();

            // sending type fields
            $table->integer('warehouse_id')->unsigned()->nullable();

            // self type fields
            $table->bigInteger('shop_id')->unsigned()->nullable();

            // references
            $table->foreign('warehouse_id')->references('id')->on('new_post_warehouses')->onDelete(DB::raw('set null'));
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete(DB::raw('set null'));
        });

        Schema::dropIfExists('order_delivery');
        Schema::dropIfExists('order_sending');
        Schema::dropIfExists('order_self');
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['warehouse_id']);
            $table->dropForeign(['shop_id']);

            $table->dropColumn([
                'city',
                'street',
                'address',
                'warehouse_id',
                'shop_id'
            ]);
        });
    }
}
