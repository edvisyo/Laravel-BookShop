<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert([
            [
                'id' => '1',
                'book_id' => '1',
                'user_id' => '1',
                'stars' => '3',
                'comment' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi tempora dolorum quaerat placeat, 
                              aliquid deserunt porro, fuga dolores reprehenderit consequuntur unde accusantium, natus aliquam illum necessitatibus 
                              ipsam nam laborum veritatis.',
                'created_at' => '2021-02-09 09:37:59',
                'updated_at' => '2021-02-09 09:37:59'
            ], 
            [
                'id' => '2',
                'book_id' => '4',
                'user_id' => '1',
                'stars' => '2',
                'comment' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi tempora dolorum quaerat placeat, 
                              aliquid deserunt porro.',
                'created_at' => '2021-02-09 09:37:59',
                'updated_at' => '2021-02-09 09:37:59'
            ], 
            [
                'id' => '3',
                'book_id' => '3',
                'user_id' => '1',
                'stars' => '3',
                'comment' => 'Cool book!',
                'created_at' => '2021-02-09 09:37:59',
                'updated_at' => '2021-02-09 09:37:59'
            ], 
            [
                'id' => '4',
                'book_id' => '4',
                'user_id' => '1',
                'stars' => '1',
                'comment' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi tempora dolorum quaerat placeat, 
                              aliquid deserunt porro, fuga dolores reprehenderit consequuntur unde accusantium, natus aliquam illum necessitatibus 
                              ipsam nam laborum veritatis.',
                'created_at' => '2021-02-09 09:37:59',
                'updated_at' => '2021-02-09 09:37:59'
            ], 
            [
                'id' => '5',
                'book_id' => '1',
                'user_id' => '1',
                'stars' => '4',
                'comment' => 'This book is really great!',
                'created_at' => '2021-02-09 09:37:59',
                'updated_at' => '2021-02-09 09:37:59'
            ]     
        ]);
    }
}
