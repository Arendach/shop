<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'name_uk' => 'Підкатегорія 1',
                'description_uk' => '',
                'meta_title_uk' => '',
                'meta_description_uk' => '',
                'meta_keywords_uk' => '',
                'name_ru' => 'Подкатегория 1',
                'description_ru' => '',
                'meta_title_ru' => '',
                'meta_description_ru' => '',
                'meta_keywords_ru' => '',
                'parent_id' => 1,
                'small' => null,
                'big' => null,
                'slug' => 'pod-category-1'
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'name_uk' => 'Підкатегорія 2',
                'description_uk' => '',
                'meta_title_uk' => '',
                'meta_description_uk' => '',
                'meta_keywords_uk' => '',
                'name_ru' => 'Подкатегория 2',
                'description_ru' => '',
                'meta_title_ru' => '',
                'meta_description_ru' => '',
                'meta_keywords_ru' => '',
                'parent_id' => 1,
                'small' => null,
                'big' => null,
                'slug' => 'pod-category-2'
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'name_uk' => 'Підкатегорія 3',
                'description_uk' => '',
                'meta_title_uk' => '',
                'meta_description_uk' => '',
                'meta_keywords_uk' => '',
                'name_ru' => 'Подкатегория 3',
                'description_ru' => '',
                'meta_title_ru' => '',
                'meta_description_ru' => '',
                'meta_keywords_ru' => '',
                'parent_id' => 2,
                'small' => null,
                'big' => null,
                'slug' => 'pod-category-3'
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'name_uk' => 'Підкатегорія 4',
                'description_uk' => '',
                'meta_title_uk' => '',
                'meta_description_uk' => '',
                'meta_keywords_uk' => '',
                'name_ru' => 'Подкатегория 4',
                'description_ru' => '',
                'meta_title_ru' => '',
                'meta_description_ru' => '',
                'meta_keywords_ru' => '',
                'parent_id' => 2,
                'small' => null,
                'big' => null,
                'slug' => 'pod-category-4'
            ],

        ]);

        DB::table('categories')->where('id', 10)->update(['parent_id' => 1]);
    }
}
