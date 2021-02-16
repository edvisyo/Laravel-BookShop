<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Role_UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_users')->insert([
            [
                'id' => '1',
                'role_id' => '2',
                'user_id' => '1'
            ], 
            [
                'id' => '2',
                'role_id' => '1',
                'user_id' => '2'
            ]      
        ]);
    }
}
