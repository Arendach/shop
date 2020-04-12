<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTemplatesToCategoryTable extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('description_template', 256)->nullable();
            $table->string('meta_title_template', 256)->nullable();
            $table->string('meta_keywords_template', 256)->nullable();
            $table->string('meta_description_template', 256)->nullable();
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn([
                'description_template',
                'meta_title_template',
                'meta_keywords_template',
                'meta_description_template'
            ]);
        });
    }
}
