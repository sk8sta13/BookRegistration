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
        Schema::create('books_subjects', function (Blueprint $table) {
            $table->unsignedBigInteger('books_id');
            $table->unsignedBigInteger('subjects_id');

            $table->foreign('books_id')->references('id')->on('books');
            $table->foreign('subjects_id')->references('id')->on('subjects');

            $table->primary(['books_id', 'subjects_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books_subjects');
    }
};
