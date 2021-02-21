<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            [
                'id' => '1',
                'username' => 'User',
                'birthdate' => '1999-08-14',
                'email' => 'test@gmail.com',
                'email_verified_at' => '2021-02-09 09:37:59',
                'password' => Hash::make('testtest'),
                'remember_token' => 'null',
                'created_at' => '2021-02-09 09:37:59',
                'updated_at' => '2021-02-09 09:37:59'
            ], 
            [
                'id' => '2',
                'username' => 'Admin',
                'birthdate' => '1989-01-18',
                'email' => 'admin@gmail.com',
                'email_verified_at' => '2021-02-09 09:37:59',
                'password' => Hash::make('adminadmin'),
                'remember_token' => 'null',
                'created_at' => '2021-02-09 09:37:59',
                'updated_at' => '2021-02-09 09:37:59'
            ]      
        ]);
    }
}
