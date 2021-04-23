<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCharacteristicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_characteristics', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('characteristic_id');
            $table->integer('product_id');
            $table->text('value_uk');
            $table->text('value_ru');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_characteristics');
    }
}
