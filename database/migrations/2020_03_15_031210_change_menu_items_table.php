<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangeMenuItemsTable extends Migration
{
    public function up()
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropColumn(['type', 'url_uk', 'url_ru']);
            $table->string('column_uk', 32)->nullable()->comment('Якщо мегаменю');
            $table->string('column_ru', 32)->nullable()->comment('Якщо мегаменю');
            $table->string('url', 1024)->default('javascript:void(0)');
        });
    }

    public function down()
    {

    }
}
