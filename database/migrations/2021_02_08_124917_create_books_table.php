<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('slug');
            $table->string('description');
            $table->string('authors');
            $table->double('price');
            // $table->bigInteger('author_id');

            // $table->unsignedBigInteger('genre_id')->nullable()->index();
            //$table->unsignedBigInteger('genre_id');
            
            // $table->bigInteger('cover_id');
            $table->text('cover');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            //$table->foreign('genre_id')->references('id')->on('genres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
