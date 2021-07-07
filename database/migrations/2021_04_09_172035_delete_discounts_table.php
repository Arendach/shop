<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('discounts');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
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
}
