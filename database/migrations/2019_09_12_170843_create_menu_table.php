<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('sort')->nullable()->default(0);
            $table->enum('type', ['link', 'drop']);
            $table->string('name_uk', 32);
            $table->string('name_ru', 32);

            $table->string('url_uk', 256)->nullable();
            $table->string('url_ru', 256)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
