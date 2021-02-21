<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([RolesTableSeeder::class, UsersTableSeeder::class, Role_UsersTableSeeder::class, GenresTableSeeder::class, AuthorsTableSeeder::class,
                    BooksTableSeeder::class, Author_BookTableSeeder::class, Book_GenreTableSeeder::class, ReviewsTableSeeder::class]);
    }
}
