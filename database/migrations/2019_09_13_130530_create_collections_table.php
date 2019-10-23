<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('parent_id')->default(0);
            $table->string('name_uk', 32);
            $table->string('name_ru', 32);
            $table->string('slug', 32)->unique();

            $table->string('meta_title_uk', 100)->nullable();
            $table->string('meta_title_ru', 100)->nullable();
            $table->string('meta_keywords_uk', 100)->nullable();
            $table->string('meta_keywords_ru', 100)->nullable();
            $table->string('meta_description_uk', 100)->nullable();
            $table->string('meta_description_ru', 100)->nullable();

            $table->text('image')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collections');
    }
}
