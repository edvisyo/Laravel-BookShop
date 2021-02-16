<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('authors')->insert([
            [
                'id' => '1',
                'fullname' => 'Dawid Watson'
            ], 
            [
                'id' => '2',
                'fullname' => 'Hannah West'
            ], 
            [
                'id' => '3',
                'fullname' => 'Kathryn ByWaters'
            ], 
            [
                'id' => '4',
                'fullname' => 'Rachel Hartman'
            ], 
            [
                'id' => '5',
                'fullname' => 'John Doe'
            ]     
        ]);
    }
}
