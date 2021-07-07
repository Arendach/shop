<?php

use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'uri_name' => 'about',

                'name_uk' => 'Про нас',
                'content_uk' => 'Про нас',
                'meta_title_uk' => 'Про нас',
                'meta_keywords_uk' => 'Про нас',
                'meta_description_uk' => 'Про нас',

                'name_ru' => 'О нас',
                'content_ru' => 'О нас',
                'meta_title_ru' => 'О нас',
                'meta_keywords_ru' => 'О нас',
                'meta_description_ru' => 'О нас',
                'deleted_at' => null,
                'static' => true,
            ],
            [
                'uri_name' => 'contacts',

                'name_uk' => 'Контакти',
                'content_uk' => 'Контакти',
                'meta_title_uk' => 'Контакти',
                'meta_keywords_uk' => 'Контакти',
                'meta_description_uk' => 'Контакти',

                'name_ru' => 'Контакты',
                'content_ru' => 'Контакты',
                'meta_title_ru' => 'Контакты',
                'meta_keywords_ru' => 'Контакты',
                'meta_description_ru' => 'Контакты',
                'deleted_at' => null,
                'static' => true,

            ],
            [
                'uri_name' => 'delivery',

                'name_uk' => 'Умови доставки',
                'content_uk' => 'Умови доставки',
                'meta_title_uk' => 'Умови доставки',
                'meta_keywords_uk' => 'Умови доставки',
                'meta_description_uk' => 'Умови доставки',

                'name_ru' => 'Условия доставки',
                'content_ru' => 'Условия доставки',
                'meta_title_ru' => 'Условия доставки',
                'meta_keywords_ru' => 'Условия доставки',
                'meta_description_ru' => 'Условия доставки',
                'deleted_at' => null,
                'static' => true,

            ],
            [
                'uri_name' => 'terms',

                'name_uk' => 'Умови погодження',
                'content_uk' => 'Умови погодження',
                'meta_title_uk' => 'Умови погодження',
                'meta_keywords_uk' => 'Умови погодження',
                'meta_description_uk' => 'Умови погодження',

                'name_ru' => 'Условия соглашения',
                'content_ru' => 'Условия соглашения',
                'meta_title_ru' => 'Условия соглашения',
                'meta_keywords_ru' => 'Условия соглашения',
                'meta_description_ru' => 'Условия соглашения',
                'deleted_at' => null,
                'static' => true,

            ],
            [
                'uri_name' => 'collaboration',

                'name_uk' => 'Співпраця',
                'content_uk' => 'Співпраця',
                'meta_title_uk' => '',
                'meta_keywords_uk' => '',
                'meta_description_uk' => '',

                'name_ru' => 'Сотрудничество',
                'content_ru' => 'Сотрудничество',
                'meta_title_ru' => '',
                'meta_keywords_ru' => '',
                'meta_description_ru' => '',
                'deleted_at' => null,
                'static' => true,
            ],
            [
                'uri_name' => 'faq',

                'name_uk' => 'Запитання та відповіді',
                'content_uk' => 'Запитання та відповіді',
                'meta_title_uk' => '',
                'meta_keywords_uk' => '',
                'meta_description_uk' => '',

                'name_ru' => 'Вопросы и ответы',
                'content_ru' => 'Вопросы и ответы',
                'meta_title_ru' => '',
                'meta_keywords_ru' => '',
                'meta_description_ru' => '',
                'deleted_at' => null,
                'static' => true,
            ],
            [
                'uri_name' => 'delivery_and_pay',

                'name_uk' => 'Доставка та оплата',
                'content_uk' => 'content',
                'meta_title_uk' => '',
                'meta_keywords_uk' => '',
                'meta_description_uk' => '',

                'name_ru' => 'Доставка и оплата',
                'content_ru' => 'content',
                'meta_title_ru' => '',
                'meta_keywords_ru' => '',
                'meta_description_ru' => '',
                'deleted_at' => null,
                'static' => true,
            ],
            [
                'uri_name' => 'articles',

                'name_uk' => 'Статті та відео',
                'content_uk' => 'content',
                'meta_title_uk' => '',
                'meta_keywords_uk' => '',
                'meta_description_uk' => '',

                'name_ru' => 'Статьи и видео',
                'content_ru' => 'content',
                'meta_title_ru' => '',
                'meta_keywords_ru' => '',
                'meta_description_ru' => '',
                'deleted_at' => null,
                'static' => true,
            ],
            [
                'uri_name' => 'discounts',

                'name_uk' => 'Знижки',
                'content_uk' => 'content',
                'meta_title_uk' => '',
                'meta_keywords_uk' => '',
                'meta_description_uk' => '',

                'name_ru' => 'Скидки',
                'content_ru' => 'content',
                'meta_title_ru' => '',
                'meta_keywords_ru' => '',
                'meta_description_ru' => '',
                'deleted_at' => null,
                'static' => true,
            ],
            [
                'uri_name' => 'discounts',

                'name_uk' => 'Знижки',
                'content_uk' => 'content',
                'meta_title_uk' => '',
                'meta_keywords_uk' => '',
                'meta_description_uk' => '',

                'name_ru' => 'Скидки',
                'content_ru' => 'content',
                'meta_title_ru' => '',
                'meta_keywords_ru' => '',
                'meta_description_ru' => '',
                'deleted_at' => null,
                'static' => true,
            ],
        ];

        DB::table('pages')->insert($data);
    }
}
