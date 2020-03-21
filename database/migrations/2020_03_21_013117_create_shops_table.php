<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShopsTable extends Migration
{
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name_uk', 256);
            $table->string('name_ru', 256);
            $table->string('address_uk', 256);
            $table->string('address_ru', 256);
            $table->string('url', 256)->nullable();
            $table->integer('base_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
