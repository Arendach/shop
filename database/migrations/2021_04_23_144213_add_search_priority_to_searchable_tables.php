<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSearchPriorityToSearchableTables extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('search_priority')->default(0);
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->integer('search_priority')->default(0);
        });

        Schema::table('collections', function (Blueprint $table) {
            $table->integer('search_priority')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('search_priority');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('search_priority');
        });

        Schema::table('collections', function (Blueprint $table) {
            $table->dropColumn('search_priority');
        });
    }
}
