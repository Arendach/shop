<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone', 32)->unique();
            $table->string('email', 64)->unique();
            $table->string('password', 32);
            $table->string('first_name', 32);
            $table->string('last_name', 32);
            $table->string('locale', 2);
            $table->string('session', 32);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
