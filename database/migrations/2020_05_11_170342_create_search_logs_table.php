<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchLogsTable extends Migration
{
    public function up()
    {
        Schema::create('search_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('query', 256)->nullable();
            $table->string('user_agent', 256)->nullable();
            $table->boolean('is_show')->default(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('search_logs');
    }
}
