<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_images', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->text('path')->nullable();
            $table->string('title_uk', 32)->nullable();
            $table->text('description_uk')->nullable();
            $table->string('alt_uk', 32)->nullable();

            $table->string('title_ru', 32)->nullable();
            $table->text('description_ru')->nullable();
            $table->string('alt_ru', 32)->nullable();

            $table->text('url_uk')->nullable();
            $table->text('url_ru')->nullable();

            $table->string('color', 32)->nullable()->default('#fff');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banner_images');
    }
}
