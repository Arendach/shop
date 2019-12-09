<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Category::class, 10)->create();
        factory(\App\Models\Product::class, 50)->create();
        factory(\App\Models\User::class, 4)->create();
        factory(\App\Models\BannerImage::class, 8)->create();
        factory(\App\Models\Discount::class, 10)->create();
        factory(\App\Models\Manufacturer::class, 15)->create();
        factory(\App\Models\Review::class, 10)->create();
        factory(\App\Models\ReviewComment::class, 10)->create();
        factory(\App\Models\ReviewThumb::class, 30)->create();

        $this->call([
            PagesSeeder::class,
            UserAccessSeeder::class,
            CategoryLinkSeeder::class,
            CharacteristicsSeeder::class,
            ProductCharacteristicsSeeder::class,
            AttributeSeeder::class,
            CategorySeeder::class,
            RelationProductSeeder::class,
            MenuSeeder::class,
            ProductCollectionSeeder::class
        ]);
    }
}
