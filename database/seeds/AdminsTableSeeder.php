<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'lastname' => 'Lising',
            'firstname' => 'Ken',
            'email' => 'techshop28dev@gmail.com',
            'password' => bcrypt('password'),
            'mobilenumber' => '09991234567',
            'job' => 'Administrator',
        ]);
    }
}
