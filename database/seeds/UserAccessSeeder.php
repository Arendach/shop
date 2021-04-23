<?php

use Illuminate\Database\Seeder;

class UserAccessSeeder extends Seeder
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
                'access_keys' => 'products,categories,users,pays',
                'name' => 'Адмін',
                'description' => 'Адмін'
            ],
            [
                'access_keys' => 'products,categories,users,pays',
                'name' => 'Курєр',
                'description' => 'Курєр'
            ]
        ];

        DB::table('user_access')->insert($data);
    }
}
