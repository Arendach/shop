<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewThumbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_thumbs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('review_id');
            $table->tinyInteger('quality');
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
        Schema::dropIfExists('review_thumbs');
    }
}
