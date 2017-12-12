<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Headphones',
        ]);

        DB::table('categories')->insert([
            'name' => 'Speakers',
        ]);

        DB::table('categories')->insert([
            'name' => 'Digital Audio Players',
        ]);

        DB::table('categories')->insert([
            'name' => 'Accessories',
        ]);
    }
}
