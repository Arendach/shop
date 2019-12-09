<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();

            $table->string('name_uk', 32);
            $table->text('description_uk')->nullable();
            $table->text('meta_title_uk')->nullable();
            $table->text('meta_description_uk')->nullable();
            $table->text('meta_keywords_uk')->nullable();

            $table->string('name_ru', 32);
            $table->text('description_ru')->nullable();
            $table->text('meta_title_ru')->nullable();
            $table->text('meta_description_ru')->nullable();
            $table->text('meta_keywords_ru')->nullable();

            $table->integer('parent_id')->default(0);

            $table->text('small')->nullable();
            $table->text('big')->nullable();

            $table->string('slug', 128)->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
