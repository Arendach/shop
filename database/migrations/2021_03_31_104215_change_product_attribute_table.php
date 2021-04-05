<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeProductAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_attributes', function (Blueprint $table) {
            $table->unsignedInteger('attribute_id')->change();
            $table->unsignedInteger('product_id')->change();
            $table->dropColumn('variants');
            $table->string('value_ru')->nullable();
            $table->string('value_uk')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_attributes', function (Blueprint $table) {
            $table->json('variants');
            $table->dropColumn('value_ru');
            $table->dropColumn('value_uk');
        });
    }
}
