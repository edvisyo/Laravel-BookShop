<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            [
                'id' => '1',
                'user_id' => '1',
                'title' => 'The King Of Drugs',
                'slug' => 'the-king-of-drugs',
                'description' => 'This is a description about the book.',
                'price' => '23',
                'cover' => 'public/seed-images/the_king_of_drugs.jpg',
                'discount' => '10',
                'approved' => '1',
                'created_at' => '2021-02-09 09:37:59',
                'updated_at' => '2021-02-09 09:37:59'
            ], 
            [
                'id' => '2',
                'user_id' => '1',
                'title' => 'Tess Of The Road',
                'slug' => 'tess-of-the-road',
                'description' => 'This is a description about the book.',
                'price' => '15',
                'cover' => 'public/seed-images/tess_of_the_road.jpg',
                'discount' => '0',
                'approved' => '0',
                'created_at' => '2021-02-09 09:37:59',
                'updated_at' => '2021-02-09 09:37:59'
            ], 
            [
                'id' => '3',
                'user_id' => '1',
                'title' => 'Realm Of Ruins',
                'slug' => 'realm-of-ruins',
                'description' => 'This is a description about the book.',
                'price' => '25',
                'cover' => 'public/seed-images/realm_of_ruins.jpg',
                'discount' => '25',
                'approved' => '1',
                'created_at' => '2021-02-09 09:37:59',
                'updated_at' => '2021-02-09 09:37:59'
            ], 
            [
                'id' => '4',
                'user_id' => '1',
                'title' => 'The Twelfth Coin Finders',
                'slug' => 'the-twelfth-coin-finders',
                'description' => 'This is a description about the book.',
                'price' => '36',
                'cover' => 'public/seed-images/the_twelfth_coin_finders.jpg',
                'discount' => '0',
                'approved' => '1',
                'created_at' => '2021-02-17 09:37:59',
                'updated_at' => '2021-02-17 09:37:59'
            ], 
            [
                'id' => '5',
                'user_id' => '1',
                'title' => 'The Past Is Rising',
                'slug' => 'the-past-is-rising',
                'description' => 'This is a description about the book.',
                'price' => '42',
                'cover' => 'public/seed-images/the_past_is_rising.jpg',
                'discount' => '0',
                'approved' => '0',
                'created_at' => '2021-02-09 09:37:59',
                'updated_at' => '2021-02-09 09:37:59'
            ]     
        ]);
    }
}
