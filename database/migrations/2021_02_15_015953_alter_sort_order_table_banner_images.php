<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSortOrderTableBannerImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banner_images', function (Blueprint $table) {
            $table->integer('sort_order');
        });
        DB::statement('UPDATE banner_images SET sort_order = id');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banner_images', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });
    }
}
