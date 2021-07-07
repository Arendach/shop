<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question_ru','255');
            $table->string('question_uk','255');
            $table->text('answer_ru');
            $table->text('answer_uk');
            $table->boolean('is_home')->default(false);
            $table->boolean('is_category')->default(false);
            $table->boolean('is_collection')->default(false);
            $table->boolean('is_other')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
        DB::statement('UPDATE `questions` SET `sort_order` = `id`');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
