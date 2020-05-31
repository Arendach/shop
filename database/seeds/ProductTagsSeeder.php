<?php

use Illuminate\Database\Seeder;
use App\Models\ProductTag;

class ProductTagsSeeder extends Seeder
{
    public function run()
    {
        factory(ProductTag::class, 500)->create();
    }
}
