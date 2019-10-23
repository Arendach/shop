<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('article', 32)->default('');
            $table->decimal('price')->default(0);
            $table->boolean('on_storage')->default(0);

            $table->string('name_uk', 128)->index()->nullable();
            $table->text('description_uk')->nullable();

            $table->string('name_ru', 128)->index()->nullable();
            $table->text('description_ru')->nullable();

            $table->unsignedInteger('category_id')->default(1);
            $table->foreign('category_id')->references('id')->on('categories');

            $table->boolean('is_new')->default(0);
            $table->boolean('is_recommended')->default(0);
            $table->decimal('discount')->nullable();

            $table->text('small')->nullable();
            $table->text('big')->nullable();
            $table->string('product_key', 32)->unique();

            $table->string('meta_title_uk', 256)->nullable();
            $table->string('meta_keywords_uk', 256)->nullable();
            $table->string('meta_description_uk', 256)->nullable();
            $table->string('meta_title_ru', 256)->nullable();
            $table->string('meta_keywords_ru', 256)->nullable();
            $table->string('meta_description_ru', 256)->nullable();

            $table->float('weight')->nullable()->default(0);

            $table->integer('manufacturer_id')->nullable();

            $table->string('slug', 256)->unique();

            $table->float('rating')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
