<?php

use Illuminate\Database\Seeder;

class CharacteristicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('characteristics')->insert([
            [
                'name_uk' => 'Висота вильоту',
                'prefix_uk' => '',
                'postfix_uk' => 'м.',
                'name_ru' => 'Высота вылета',
                'prefix_ru' => '',
                'postfix_ru' => 'м.',
                'type' => 'slider'
            ],

            [
                'name_uk' => 'Колір',
                'prefix_uk' => '',
                'postfix_uk' => '',
                'name_ru' => 'Цвет',
                'prefix_ru' => '',
                'postfix_ru' => '',
                'type' => 'switch'
            ],

            [
                'name_uk' => 'Тип салюту',
                'prefix_uk' => '',
                'postfix_uk' => '',
                'name_ru' => 'Тып салюта',
                'prefix_ru' => '',
                'postfix_ru' => '',
                'type' => 'flags'
            ],

            [
                'name_uk' => 'Калібр',
                'prefix_uk' => '',
                'postfix_uk' => 'мм.',

                'name_ru' => 'Калибр',
                'prefix_ru' => '',
                'postfix_ru' => 'мм.',

                'type' => 'slider-diapason'
            ],

        ]);
    }
}
