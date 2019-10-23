<?php

use App\Models\ProductCollection;
use App\Models\ProductCollectionItems;
use Illuminate\Database\Seeder;

class ProductCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductCollection::insert([
            [
                'parent_id' => 0,
                'name_uk' => 'Колекція номер 1',
                'name_ru' => 'Коллекция номер 1',
                'slug' => 'collection-1',
                'meta_title_uk' => 'Колекція колекцій',
                'meta_title_ru' => 'Коллекция коллекций',
                'meta_keywords_uk' => 'мета кейвордс українською',
                'meta_keywords_ru' => 'мета кейвордс на русском',
                'meta_description_uk' => 'мета дескріпшен українською',
                'meta_description_ru' => 'мета дескрипшн на русском',
                'image' => null
            ], [
                'parent_id' => 0,
                'name_uk' => 'Колекція номер 2',
                'name_ru' => 'Коллекция номер 2',
                'slug' => 'collection-2',
                'meta_title_uk' => 'Колекція колекцій',
                'meta_title_ru' => 'Коллекция коллекций',
                'meta_keywords_uk' => 'мета кейвордс українською',
                'meta_keywords_ru' => 'мета кейвордс на русском',
                'meta_description_uk' => 'мета дескріпшен українською',
                'meta_description_ru' => 'мета дескрипшн на русском',
                'image' => null
            ], [
                'parent_id' => 0,
                'name_uk' => 'Колекція номер 3',
                'name_ru' => 'Коллекция номер 3',
                'slug' => 'collection-3',
                'meta_title_uk' => 'Колекція колекцій',
                'meta_title_ru' => 'Коллекция коллекций',
                'meta_keywords_uk' => 'мета кейвордс українською',
                'meta_keywords_ru' => 'мета кейвордс на русском',
                'meta_description_uk' => 'мета дескріпшен українською',
                'meta_description_ru' => 'мета дескрипшн на русском',
                'image' => null
            ], [
                'parent_id' => 0,
                'name_uk' => 'Колекція номер 4',
                'name_ru' => 'Коллекция номер 4',
                'slug' => 'collection-4',
                'meta_title_uk' => 'Колекція колекцій',
                'meta_title_ru' => 'Коллекция коллекций',
                'meta_keywords_uk' => 'мета кейвордс українською',
                'meta_keywords_ru' => 'мета кейвордс на русском',
                'meta_description_uk' => 'мета дескріпшен українською',
                'meta_description_ru' => 'мета дескрипшн на русском',
                'image' => null
            ],



            [
                'parent_id' => 1,
                'name_uk' => 'Під-колекція 1',
                'name_ru' => 'Под-коллекция 1',
                'slug' => 'inner-collection-1',
                'meta_title_uk' => 'Колекція колекцій child',
                'meta_title_ru' => 'Коллекция коллекций child',
                'meta_keywords_uk' => 'мета кейвордс українською child',
                'meta_keywords_ru' => 'мета кейвордс на русском child',
                'meta_description_uk' => 'мета дескріпшен українською child',
                'meta_description_ru' => 'мета дескрипшн на русском child',
                'image' => null
            ],
            [
                'parent_id' => 1,
                'name_uk' => 'Під-колекція 2',
                'name_ru' => 'Под-коллекция 2',
                'slug' => 'inner-collection-2',
                'meta_title_uk' => 'Колекція колекцій child',
                'meta_title_ru' => 'Коллекция коллекций child',
                'meta_keywords_uk' => 'мета кейвордс українською child',
                'meta_keywords_ru' => 'мета кейвордс на русском child',
                'meta_description_uk' => 'мета дескріпшен українською child',
                'meta_description_ru' => 'мета дескрипшн на русском child',
                'image' => null
            ],
            [
                'parent_id' => 1,
                'name_uk' => 'Під-колекція 3',
                'name_ru' => 'Под-коллекция 3',
                'slug' => 'inner-collection-3',
                'meta_title_uk' => 'Колекція колекцій child',
                'meta_title_ru' => 'Коллекция коллекций child',
                'meta_keywords_uk' => 'мета кейвордс українською child',
                'meta_keywords_ru' => 'мета кейвордс на русском child',
                'meta_description_uk' => 'мета дескріпшен українською child',
                'meta_description_ru' => 'мета дескрипшн на русском child',
                'image' => null
            ],
            [
                'parent_id' => 1,
                'name_uk' => 'Під-колекція 4',
                'name_ru' => 'Под-коллекция 4',
                'slug' => 'inner-collection-4',
                'meta_title_uk' => 'Колекція колекцій child',
                'meta_title_ru' => 'Коллекция коллекций child',
                'meta_keywords_uk' => 'мета кейвордс українською child',
                'meta_keywords_ru' => 'мета кейвордс на русском child',
                'meta_description_uk' => 'мета дескріпшен українською child',
                'meta_description_ru' => 'мета дескрипшн на русском child',
                'image' => null
            ],
            [
                'parent_id' => 1,
                'name_uk' => 'Під-колекція 5',
                'name_ru' => 'Под-коллекция 5',
                'slug' => 'inner-collection-5',
                'meta_title_uk' => 'Колекція колекцій child',
                'meta_title_ru' => 'Коллекция коллекций child',
                'meta_keywords_uk' => 'мета кейвордс українською child',
                'meta_keywords_ru' => 'мета кейвордс на русском child',
                'meta_description_uk' => 'мета дескріпшен українською child',
                'meta_description_ru' => 'мета дескрипшн на русском child',
                'image' => null
            ],




            [
                'parent_id' => 2,
                'name_uk' => 'Під-колекція 1',
                'name_ru' => 'Под-коллекция 1',
                'slug' => 'inner-collection-12',
                'meta_title_uk' => 'Колекція колекцій child',
                'meta_title_ru' => 'Коллекция коллекций child',
                'meta_keywords_uk' => 'мета кейвордс українською child',
                'meta_keywords_ru' => 'мета кейвордс на русском child',
                'meta_description_uk' => 'мета дескріпшен українською child',
                'meta_description_ru' => 'мета дескрипшн на русском child',
                'image' => null
            ],
            [
                'parent_id' => 2,
                'name_uk' => 'Під-колекція 2',
                'name_ru' => 'Под-коллекция 2',
                'slug' => 'inner-collection-22',
                'meta_title_uk' => 'Колекція колекцій child',
                'meta_title_ru' => 'Коллекция коллекций child',
                'meta_keywords_uk' => 'мета кейвордс українською child',
                'meta_keywords_ru' => 'мета кейвордс на русском child',
                'meta_description_uk' => 'мета дескріпшен українською child',
                'meta_description_ru' => 'мета дескрипшн на русском child',
                'image' => null
            ],
            [
                'parent_id' => 2,
                'name_uk' => 'Під-колекція 3',
                'name_ru' => 'Под-коллекция 3',
                'slug' => 'inner-collection-32',
                'meta_title_uk' => 'Колекція колекцій child',
                'meta_title_ru' => 'Коллекция коллекций child',
                'meta_keywords_uk' => 'мета кейвордс українською child',
                'meta_keywords_ru' => 'мета кейвордс на русском child',
                'meta_description_uk' => 'мета дескріпшен українською child',
                'meta_description_ru' => 'мета дескрипшн на русском child',
                'image' => null
            ],
            [
                'parent_id' => 2,
                'name_uk' => 'Під-колекція 4',
                'name_ru' => 'Под-коллекция 4',
                'slug' => 'inner-collection-42',
                'meta_title_uk' => 'Колекція колекцій child',
                'meta_title_ru' => 'Коллекция коллекций child',
                'meta_keywords_uk' => 'мета кейвордс українською child',
                'meta_keywords_ru' => 'мета кейвордс на русском child',
                'meta_description_uk' => 'мета дескріпшен українською child',
                'meta_description_ru' => 'мета дескрипшн на русском child',
                'image' => null
            ],
            [
                'parent_id' => 2,
                'name_uk' => 'Під-колекція 5',
                'name_ru' => 'Под-коллекция 5',
                'slug' => 'inner-collection-52',
                'meta_title_uk' => 'Колекція колекцій child',
                'meta_title_ru' => 'Коллекция коллекций child',
                'meta_keywords_uk' => 'мета кейвордс українською child',
                'meta_keywords_ru' => 'мета кейвордс на русском child',
                'meta_description_uk' => 'мета дескріпшен українською child',
                'meta_description_ru' => 'мета дескрипшн на русском child',
                'image' => null
            ],
        ]);

        ProductCollectionItems::insert([
            ['collection_id' => 5, 'product_id' => 1],
            ['collection_id' => 5, 'product_id' => 2],
            ['collection_id' => 5, 'product_id' => 3],
            ['collection_id' => 5, 'product_id' => 4],
            ['collection_id' => 5, 'product_id' => 5],
            ['collection_id' => 5, 'product_id' => 6],
            ['collection_id' => 5, 'product_id' => 7],
            ['collection_id' => 5, 'product_id' => 8],
            ['collection_id' => 5, 'product_id' => 9],
            ['collection_id' => 5, 'product_id' => 10],
            ['collection_id' => 5, 'product_id' => 11],
        ]);
    }
}
