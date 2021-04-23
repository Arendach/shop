<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixChangelogBug extends Migration
{
    public function up()
    {
        Schema::table('action_events', function (Blueprint $table) {
            $table->longText('changes')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('action_events', function (Blueprint $table) {
            $table->longText('changes')->nullable()->change();
        });
    }
}
