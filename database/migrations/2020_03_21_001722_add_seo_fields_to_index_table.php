<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSeoFieldsToIndexTable extends Migration
{
    public function up()
    {
        Schema::table('indexes', function (Blueprint $table) {
            $table->string('meta_title_uk', 128)->nullable();
            $table->string('meta_keywords_uk', 128)->nullable();
            $table->string('meta_description_uk', 128)->nullable();
            $table->string('meta_title_ru', 128)->nullable();
            $table->string('meta_keywords_ru', 128)->nullable();
            $table->string('meta_description_ru', 128)->nullable();

            $table->text('article_uk')->nullable();
            $table->text('article_ru')->nullable();
        });
    }

    public function down()
    {
        Schema::table('indexes', function (Blueprint $table) {
            $table->dropColumn([
                'meta_title_uk',
                'meta_keywords_uk',
                'meta_description_uk',
                'meta_title_ru',
                'meta_keywords_ru',
                'meta_description_ru',
                'article_uk',
                'article_ru'
            ]);
        });
    }
}
