<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'lastname' => 'Lising',
            'firstname' => 'Ken',
            'email' => 'kennlising23@gmail.com',
            'password' => bcrypt('password'),
            'address' => 'address ko sa bahay', 
            'mobilenumber' => '09991234567',
            'verifyStatus' => true,
            'province_id'=> 47,
        ]);
    }
}
