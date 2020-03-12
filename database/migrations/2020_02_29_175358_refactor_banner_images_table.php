<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RefactorBannerImagesTable extends Migration
{
    public function up()
    {
        Schema::table('banner_images', function (Blueprint $table) {
            $table->renameColumn('path', 'image');
            $table->renameColumn('alt_uk', 'button_uk');
            $table->renameColumn('alt_ru', 'button_ru');
            $table->renameColumn('url_uk', 'url');
            $table->renameColumn('url_ru', 'position');
        });
    }

    public function down()
    {
        Schema::table('banner_images', function (Blueprint $table) {
            $table->renameColumn('image', 'path');
            $table->renameColumn('button_uk', 'alt_uk');
            $table->renameColumn('button_ru', 'alt_ru');
            $table->renameColumn('url', 'url_uk');
            $table->renameColumn('position', 'url_ru');
        });
    }
}
