<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndexesTable extends Migration
{
    public function up()
    {
        Schema::create('indexes', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 32);
            $table->string('logo', 1024)->nullable()->comment('Логотип сайту');
            $table->string('header_phone', 32)->nullable()->comment('Номер телефона в шапці');
            $table->string('copyright')->nullable()->default('Skyfire ')->comment('Копірайт (без років)');
            $table->string('footer_phone')->nullable()->comment('Номер телефона в футері');
            $table->string('footer_address_uk')->nullable()->comment('Адреса магазину в футері');
            $table->string('footer_address_ru')->nullable()->comment('Адреса магазину в футері');
            $table->string('footer_email')->nullable()->comment('Електронна пошта в футері');

            $table->boolean('is_main')->default(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('indexes');
    }
}
