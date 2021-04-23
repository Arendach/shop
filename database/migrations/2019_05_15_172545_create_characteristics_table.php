<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacteristicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characteristics', function (Blueprint $table) {
            $table->increments('id');

            $table->text('name_uk');
            $table->text('prefix_uk')->nullable();
            $table->text('postfix_uk')->nullable();

            $table->text('name_ru');
            $table->text('prefix_ru')->nullable();
            $table->text('postfix_ru')->nullable();

            $table->string('type', 32)->default('flags');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characteristics');
    }
}
