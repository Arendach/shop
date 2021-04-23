<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangeReviewsTable extends Migration
{

    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->renameColumn('plus', 'title');
            $table->dropColumn(['minus', 'thumb_up', 'thumb_down']);
            $table->boolean('is_checked')->default(false);
        });
    }

    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->renameColumn('title', 'plus');
            $table->dropColumn('is_checked');
            $table->text('minus')->nullable();
            $table->integer('thumb_up')->default(0);
            $table->integer('thumb_down')->default(0);
        });
    }
}