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
            ], 
            [
                'id' => '6',
                'book_id' => '6',
                'genre_id' => '3'
            ], 
            [
                'id' => '7',
                'book_id' => '6',
                'genre_id' => '1'
            ], 
            [
                'id' => '8',
                'book_id' => '7',
                'genre_id' => '1'
            ], 
            [
                'id' => '9',
                'book_id' => '7',
                'genre_id' => '3'
            ], 
            [
                'id' => '10',
                'book_id' => '7',
                'genre_id' => '5'
            ]      
        ]);
    }
}
