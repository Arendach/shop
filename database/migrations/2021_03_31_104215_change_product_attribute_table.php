<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeProductAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_attributes', function (Blueprint $table) {
            $table->unsignedInteger('attribute_id')->change();
            $table->foreign('attribute_id')->references('id')->on('attributes');
            $table->unsignedInteger('product_id')->change();
            $table->foreign('product_id')->references('id')->on('products');
            $table->dropColumn('variants');
            $table->string('value_ru');
            $table->string('value_uk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_attributes', function (Blueprint $table) {
            $table->dropColumn('value_ru');
            $table->dropColumn('value_uk');
        });
    }
}
