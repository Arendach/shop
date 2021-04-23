<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('menu_id');
            $table->string('name_uk', 32);
            $table->string('name_ru', 32);
            $table->enum('type', ['link', 'text'])->default('text');
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
        Schema::dropIfExists('menu_items');
    }
}
