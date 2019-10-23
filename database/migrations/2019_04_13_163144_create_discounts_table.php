<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->date('start')->nullable();
            $table->date('finish')->nullable();
            $table->text('name_uk')->nullable();
            $table->text('name_ru')->nullable();
            $table->text('image_min_uk')->nullable();
            $table->text('image_second_uk')->nullable();
            $table->text('image_max_uk')->nullable();
            $table->text('image_min_ru')->nullable();
            $table->text('image_second_ru')->nullable();
            $table->text('image_max_ru')->nullable();
            $table->string('page', 32)->nullable();
            $table->string('published', 32)->default(0);
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}
