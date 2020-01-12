<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('key');
            $table->text('value_uk');
            $table->text('value_ru');
            $table->string('description_uk');
            $table->string('description_ru');
        });
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
