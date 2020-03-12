<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCustomerColumns extends Migration
{
    public function up()
    {
        Schema::table('desire_products', function (Blueprint $table){
            $table->renameColumn('user_id', 'customer_id');
        });

        Schema::table('carts', function (Blueprint $table){
            $table->renameColumn('user_id', 'customer_id');
        });

        Schema::table('orders', function (Blueprint $table){
            $table->renameColumn('user_id', 'customer_id');
        });

        Schema::table('reviews', function (Blueprint $table){
            $table->renameColumn('user_id', 'customer_id');
        });

        Schema::table('review_comments', function (Blueprint $table){
            $table->renameColumn('user_id', 'customer_id');
        });
    }

    public function down()
    {
        Schema::table('desire_products', function (Blueprint $table){
            $table->renameColumn('customer_id', 'user_id');
        });

        Schema::table('carts', function (Blueprint $table){
            $table->renameColumn('customer_id', 'user_id');
        });

        Schema::table('orders', function (Blueprint $table){
            $table->renameColumn('customer_id', 'user_id');
        });

        Schema::table('reviews', function (Blueprint $table){
            $table->renameColumn('customer_id', 'user_id');
        });

        Schema::table('review_comments', function (Blueprint $table){
            $table->renameColumn('customer_id', 'user_id');
        });
    }
}
