<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveDescriptionFromSettingsTable extends Migration
{
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'description_uk',
                'description_ru',
            ]);
        });
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('description_uk')->nullable();
            $table->string('description_ru')->nullable();
        });
    }
}
