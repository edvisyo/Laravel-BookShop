<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Author_BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('author_book')->insert([
            [
                'id' => '1',
                'author_id' => '1',
                'book_id' => '1'
            ], 
            [
                'id' => '2',
                'author_id' => '4',
                'book_id' => '2'
            ], 
            [
                'id' => '3',
                'author_id' => '2',
                'book_id' => '3'
            ], 
            [
                'id' => '4',
                'author_id' => '5',
                'book_id' => '4'
            ], 
            [
                'id' => '5',
                'author_id' => '3',
                'book_id' => '5'
            ]     
        ]);
    }
}
