<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('product_id');
            $table->integer('user_id');
            $table->text('comment');
            $table->text('plus')->default(null)->nullable();
            $table->text('minus')->default(null)->nullable();
            $table->tinyInteger('rating')->default(0)->nullable();
            $table->integer('thumb_up')->default(0)->nullable();
            $table->integer('thumb_down')->default(0)->nullable();

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
        Schema::dropIfExists('reviews');
    }
}
