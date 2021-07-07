<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedirectsTable extends Migration
{
    public function up()
    {
        Schema::create('redirects', function (Blueprint $table) {
            $table->id();
            $table->string('old_link', 256);
            $table->string('new_link', 256);
            $table->string('status')->default(301);
        });
    }

    public function down()
    {
        Schema::dropIfExists('redirects');
    }
}
