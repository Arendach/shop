<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class SetupNewPostRelation extends Migration
{
    public function up()
    {
        Schema::table('new_post_warehouses', function (Blueprint $table) {
            $table->integer('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('new_post_cities')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('new_post_warehouses', function (Blueprint $table) {
             $table->dropForeign(['city_id']);
             $table->dropColumn('city_id');
        });
    }
}
