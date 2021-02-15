<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            [
                'name' => 'action'
            ], 
            [
                'name' => 'adventure'
            ], 
            [
                'name' => 'fantasy'
            ], 
            [
                'name' => 'historical'
            ], 
            [
                'name' => 'horror'
            ], 
            [
                'name' => 'romance'
            ]     
        ]);
    }
}
