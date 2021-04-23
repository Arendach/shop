<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslatesTable extends Migration
{
    public function up()
    {
        Schema::create('translates', function (Blueprint $table) {
            $table->increments('id');

            $table->text('original');

            $table->text('content_uk');
            $table->text('content_ru');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('translates');
    }
}
