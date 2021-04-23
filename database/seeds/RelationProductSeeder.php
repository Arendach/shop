<?php

use App\Models\RelationProduct;
use Illuminate\Database\Seeder;

class RelationProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        for ($i = 2; $i <= 8; $i++){
            $data[] = [
                'product_id' => 1,
                'related_id' => $i
            ];
        }

        RelationProduct::insert($data);
    }
}
