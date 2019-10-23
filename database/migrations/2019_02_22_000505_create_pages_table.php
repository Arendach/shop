<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();

            $table->string('uri_name', 32);
            $table->boolean('static')->default(false);

            $table->text('name_uk');
            $table->text('content_uk');
            $table->text('meta_title_uk');
            $table->text('meta_keywords_uk');
            $table->text('meta_description_uk');

            $table->text('name_ru');
            $table->text('content_ru');
            $table->text('meta_title_ru');
            $table->text('meta_keywords_ru');
            $table->text('meta_description_ru');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
