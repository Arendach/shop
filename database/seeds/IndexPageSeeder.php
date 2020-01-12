<?php

use Illuminate\Database\Seeder;
use App\Models\Page;

class IndexPageSeeder extends Seeder
{
    public function run()
    {
        if (!Page::where('uri_name', 'index')->count()) {
            Page::create([
                'created_at'          => now(),
                'updated_at'          => now(),
                'deleted_at'          => null,
                'uri_name'            => 'index',
                'static'              => true,
                'name_uk'             => 'Index',
                'name_ru'             => 'Index',
                'content_uk'          => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab deleniti dignissimos dolorem fuga inventore iste mollitia quasi, ratione! Cum deserunt dolore, doloremque earum itaque libero nam? Asperiores et nesciunt veritatis.',
                'content_ru'          => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab deleniti dignissimos dolorem fuga inventore iste mollitia quasi, ratione! Cum deserunt dolore, doloremque earum itaque libero nam? Asperiores et nesciunt veritatis.',
                'meta_title_uk'       => 'Мій магазин',
                'meta_title_ru'       => 'Мой магазин',
                'meta_description_uk' => 'Мій магазин',
                'meta_description_ru' => 'Мой магазин',
                'meta_keywords_uk'    => 'Мій магазин',
                'meta_keywords_ru'    => 'Мой магазин',
            ]);
        }

        echo "Index Page Created \n";
    }
}