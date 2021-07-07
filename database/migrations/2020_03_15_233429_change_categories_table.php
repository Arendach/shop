<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table){
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table){
            $table->dropColumn(['is_active', 'order']);
        });
    }
}
