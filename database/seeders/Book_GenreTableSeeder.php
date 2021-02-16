<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Book_GenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('book_genre')->insert([
            [
                'id' => '1',
                'book_id' => '1',
                'genre_id' => '1'
            ], 
            [
                'id' => '2',
                'book_id' => '2',
                'genre_id' => '2'
            ], 
            [
                'id' => '3',
                'book_id' => '3',
                'genre_id' => '3'
            ], 
            [
                'id' => '4',
                'book_id' => '4',
                'genre_id' => '4'
            ], 
            [
                'id' => '5',
                'book_id' => '5',
                'genre_id' => '5'
            ]     
        ]);
    }
}
