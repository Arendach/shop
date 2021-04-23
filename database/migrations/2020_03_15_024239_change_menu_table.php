<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangeMenuTable extends Migration
{
    public function up()
    {
        DB::table('menu')->truncate();

        Schema::table('menu', function (Blueprint $table) {
            $table->dropColumn(['url_uk', 'url_ru', 'type']);

            $table->string('photo', 1024)->nullable();
            $table->string('url', 256)->default('javascript:void(0)');
            $table->string('role', 32)->default('link');
        });
    }

    public function down()
    {

    }
}
