<?php

use App\Models\Menu;
use App\Models\MenuItems;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        Menu::create([
            'name_uk' => 'Головна',
            'name_ru' => 'Главная',
            'url'     => '/',
            'role'    => 'link'
        ]);


        $menu = Menu::create([
            'name_uk' => 'Меню',
            'name_ru' => 'Меню',
            'role'    => 'menu'
        ]);

        MenuItems::insert([
            [
                'menu_id' => $menu->id,
                'name_uk' => 'Пункт 1',
                'name_ru' => 'Пункт 1',
                'url'     => '/test/punkt-1'
            ],

            [
                'menu_id' => $menu->id,
                'name_uk' => 'Пункт 2',
                'name_ru' => 'Пункт 2',
                'url'     => '/test/punkt-2'
            ],

            [
                'menu_id' => $menu->id,
                'name_uk' => 'Пункт 3',
                'name_ru' => 'Пункт 3',
                'url'     => '/test/punkt-3'
            ],


        ]);


        $megamenu = Menu::create([
            'name_uk' => 'Мегаменю',
            'name_ru' => 'Меню',
            'role'    => 'megamenu',
            'photo'   => '/catalog/img/banner_menu.jpg'
        ]);

        MenuItems::insert([
            [
                'menu_id'   => $megamenu->id,
                'name_uk'   => 'Пункт 1',
                'name_ru'   => 'Пункт 1',
                'url'       => '/test/punkt-1',
                'column_uk' => 'Колонка 1',
                'column_ru' => 'Колонка 1',
            ],

            [
                'menu_id'   => $megamenu->id,
                'name_uk'   => 'Пункт 2',
                'name_ru'   => 'Пункт 2',
                'url'       => '/test/punkt-2',
                'column_uk' => 'Колонка 1',
                'column_ru' => 'Колонка 1',
            ],

            [
                'menu_id'   => $megamenu->id,
                'name_uk'   => 'Пункт 3',
                'name_ru'   => 'Пункт 3',
                'url'       => '/test/punkt-3',
                'column_uk' => 'Колонка 1',
                'column_ru' => 'Колонка 1',
            ],


            [
                'menu_id'   => $megamenu->id,
                'name_uk'   => 'Пункт 1',
                'name_ru'   => 'Пункт 1',
                'url'       => '/test/punkt-1',
                'column_uk' => 'Колонка 2',
                'column_ru' => 'Колонка 2',
            ],

            [
                'menu_id'   => $megamenu->id,
                'name_uk'   => 'Пункт 2',
                'name_ru'   => 'Пункт 2',
                'url'       => '/test/punkt-2',
                'column_uk' => 'Колонка 2',
                'column_ru' => 'Колонка 2',
            ],

            [
                'menu_id'   => $megamenu->id,
                'name_uk'   => 'Пункт 3',
                'name_ru'   => 'Пункт 3',
                'url'       => '/test/punkt-3',
                'column_uk' => 'Колонка 2',
                'column_ru' => 'Колонка 2',
            ],


            [
                'menu_id'   => $megamenu->id,
                'name_uk'   => 'Пункт 1',
                'name_ru'   => 'Пункт 1',
                'url'       => '/test/punkt-1',
                'column_uk' => 'Колонка 3',
                'column_ru' => 'Колонка 3',
            ],

            [
                'menu_id'   => $megamenu->id,
                'name_uk'   => 'Пункт 2',
                'name_ru'   => 'Пункт 2',
                'url'       => '/test/punkt-2',
                'column_uk' => 'Колонка 3',
                'column_ru' => 'Колонка 3',
            ],

            [
                'menu_id'   => $megamenu->id,
                'name_uk'   => 'Пункт 3',
                'name_ru'   => 'Пункт 3',
                'url'       => '/test/punkt-3',
                'column_uk' => 'Колонка 3',
                'column_ru' => 'Колонка 3',
            ],
        ]);
    }
}
