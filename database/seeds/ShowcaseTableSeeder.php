<?php

use Illuminate\Database\Seeder;

class ShowcaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            'name' => 'Wireless Collection 20% Off',
            'description' => 'This Is A Test Description',
            'banner' => 'demoshowcase1.jpg',
        ]);

        DB::table('brands')->insert([
            'name' => 'Beastly Collection 20% Off',
            'description' => 'This Is A Test Description',
            'banner' => 'demoshowcase2.jpg',
        ]);

        DB::table('brands')->insert([
            'name' => 'Hey Hey It is Payday Sale 20% Off',
            'description' => 'This Is A Test Description',
            'banner' => 'demoshowcase3.jpg',
        ]);

        DB::table('brands')->insert([
            'name' => 'Gamers by Gamers Collection 20% Off',
            'description' => 'This Is A Test Description',
            'banner' => 'demoshowcase4.jpg',
        ]);

        DB::table('brands')->insert([
            'name' => 'Soul For Sale 20% Off',
            'description' => 'This Is A Test Description',
            'banner' => 'demoshowcase5.jpg',
        ]);
    }
}
