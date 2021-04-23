<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFilterColumnsToProductCharacteristicsTable extends Migration
{
    public function up()
    {
        Schema::table('product_characteristics', function (Blueprint $table) {
            $table->string('filter_uk', 128)->nullable();
            $table->string('filter_ru', 128)->nullable();
        });
    }

    public function down()
    {
        Schema::table('product_characteristics', function (Blueprint $table) {
            $table->dropColumn([
                'filter_uk',
                'filter_ru'
            ]);
        });
    }
}
