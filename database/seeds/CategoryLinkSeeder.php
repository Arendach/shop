<?php

use Illuminate\Database\Seeder;

class CategoryLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_links')->insert([
            [
                'category_id' => 1,
                'name_uk' => 'Продукт 1',
                'name_ru' => 'Товар 1',
                'url_uk' => '/products/1',
                'url_ru' => '/ru/products/1'
            ],
            [
                'category_id' => 1,
                'name_uk' => 'Продукт 2',
                'name_ru' => 'Товар 2',
                'url_uk' => '/products/2',
                'url_ru' => '/ru/products/2'
            ],
            [
                'category_id' => 1,
                'name_uk' => 'Продукт 3',
                'name_ru' => 'Товар 3',
                'url_uk' => '/products/3',
                'url_ru' => '/ru/products/3'
            ]
        ]);
    }
}
