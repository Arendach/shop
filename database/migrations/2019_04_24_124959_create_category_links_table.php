<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_links', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('category_id');
            $table->string('name_uk', 32);
            $table->string('name_ru', 32);
            $table->string('url_uk', 128);
            $table->string('url_ru', 128);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_links');
    }
}
