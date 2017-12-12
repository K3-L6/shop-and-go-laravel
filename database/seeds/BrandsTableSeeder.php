<?php

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            'name' => 'Brainwavz',
            'description' => 'This Is A Test Description'
        ]);

        DB::table('brands')->insert([
            'name' => 'Fiio',
            'description' => 'This Is A Test Description'
        ]);

        DB::table('brands')->insert([
            'name' => 'Grado Labs',
            'description' => 'This Is A Test Description'
        ]);

        DB::table('brands')->insert([
            'name' => 'Sound Magic',
            'description' => 'This Is A Test Description'
        ]);

        DB::table('brands')->insert([
            'name' => 'Xiaomi',
            'description' => 'This Is A Test Description'
        ]);
    }
}
