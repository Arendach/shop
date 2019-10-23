<?php

use Illuminate\Database\Seeder;

class ProductCharacteristicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_characteristics')->insert([
            [
                'characteristic_id' => 1,
                'product_id' => 1,
                'value_uk' => '100',
                'value_ru' => '100'
            ],
            [
                'characteristic_id' => 2,
                'product_id' => 1,
                'value_uk' => 'зелений',
                'value_ru' => 'зеленый'
            ],
            [
                'characteristic_id' => 3,
                'product_id' => 1,
                'value_uk' => 'Прямострільні',
                'value_ru' => 'Прямострельные'
            ],
            [
                'characteristic_id' => 4,
                'product_id' => 1,
                'value_uk' => '21',
                'value_ru' => '21'
            ],
        ]);
    }
}
