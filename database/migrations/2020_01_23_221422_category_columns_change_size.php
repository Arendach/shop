<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CategoryColumnsChangeSize extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('name_uk', 128)->change();
            $table->string('name_ru', 128)->change();
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('name_uk', 32)->change();
            $table->string('name_ru', 32)->change();
        });
    }
}
