<?php

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::insert([
            [
                'sort' => 0,
                'type' => 'drop',
                'name_uk' => 'Контакти',
                'name_ru' => 'Контакты',
                'url_uk' => '#',
                'url_ru' => '#',
            ],
            [
                'sort' => 1,
                'type' => 'link',
                'name_uk' => 'Про нас',
                'name_ru' => 'О нас',
                'url_uk' => 'page/about',
                'url_ru' => 'ru/page/about',
            ],
            [
                'sort' => 2,
                'type' => 'link',
                'name_uk' => 'Колекції товарів',
                'name_ru' => 'Коллекции товаров',
                'url_uk' => 'collections',
                'url_ru' => 'ru/collections',
            ],
            [
                'sort' => 3,
                'type' => 'drop',
                'name_uk' => 'Мова',
                'name_ru' => 'Язык',
                'url_uk' => '#',
                'url_ru' => '#',
            ]
        ]);

        MenuItem::insert([
            [
                'menu_id' => 1,
                'type' => 'text',
                'name_uk' => '+38096446851',
                'name_ru' => '+38096446851',
                'url_uk' => null,
                'url_ru' => null,
            ],
            [
                'menu_id' => 1,
                'type' => 'text',
                'name_uk' => '+380976177213',
                'name_ru' => '+380976177213',
                'url_uk' => null,
                'url_ru' => null,
            ],
            [
                'menu_id' => 1,
                'type' => 'text',
                'name_uk' => '+38096678658',
                'name_ru' => '+38096678658',
                'url_uk' => null,
                'url_ru' => null,
            ],
            [
                'menu_id' => 4,
                'type' => 'link',
                'name_uk' => 'Українська',
                'name_ru' => 'Украинский',
                'url_uk' => 'locale/uk',
                'url_ru' => 'locale/uk',
            ],
            [
                'menu_id' => 4,
                'type' => 'link',
                'name_uk' => 'Російська',
                'name_ru' => 'Русский',
                'url_uk' => 'locale/ru',
                'url_ru' => 'locale/ru',
            ],

        ]);
    }
}
