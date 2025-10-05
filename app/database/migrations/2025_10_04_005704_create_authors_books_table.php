<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors_books', function (Blueprint $table) {
            $table->unsignedBigInteger('books_id');
            $table->unsignedBigInteger('authors_id');

            $table->foreign('books_id')->references('id')->on('books');
            $table->foreign('authors_id')->references('id')->on('authors');

            $table->primary(['books_id', 'authors_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authors_books');
    }
};
