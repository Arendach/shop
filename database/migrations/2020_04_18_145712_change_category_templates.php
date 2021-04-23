<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCategoryTemplates extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->text('name_template')->nullable()->change();
            $table->text('description_template')->nullable()->change();
            $table->text('meta_title_template')->nullable()->change();
            $table->text('meta_keywords_template')->nullable()->change();
            $table->text('meta_description_template')->nullable()->change();

            $table->renameColumn('name_template', 'name_template_uk');
            $table->renameColumn('description_template', 'description_template_uk');
            $table->renameColumn('meta_title_template', 'meta_title_template_uk');
            $table->renameColumn('meta_keywords_template', 'meta_keywords_template_uk');
            $table->renameColumn('meta_description_template', 'meta_description_template_uk');

            $table->text('name_template_ru')->nullable();
            $table->text('description_template_ru')->nullable();
            $table->text('meta_title_template_ru')->nullable();
            $table->text('meta_keywords_template_ru')->nullable();
            $table->text('meta_description_template_ru')->nullable();
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn([
                'name_template_ru',
                'description_template_ru',
                'meta_title_template_ru',
                'meta_keywords_template_ru',
                'meta_description_template_ru'
            ]);
            $table->string('name_template_uk', 256)->nullable()->change();
            $table->string('description_template_uk', 256)->nullable()->change();
            $table->string('meta_title_template_uk', 256)->nullable()->change();
            $table->string('meta_keywords_template_uk', 256)->nullable()->change();
            $table->string('meta_description_template_uk', 256)->nullable()->change();

            $table->renameColumn('name_template_uk', 'name_template');
            $table->renameColumn('description_template_uk', 'description_template');
            $table->renameColumn('meta_title_template_uk', 'meta_title_template');
            $table->renameColumn('meta_keywords_template_uk', 'meta_keywords_template');
            $table->renameColumn('meta_description_template_uk', 'meta_description_template');
        });
    }
}
