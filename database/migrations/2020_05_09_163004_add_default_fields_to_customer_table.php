<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultFieldsToCustomerTable extends Migration
{
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('locale', 2)->default('uk')->change();
        });
    }

    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('locale', 2)->default('uk')->change();
        });
    }
}
