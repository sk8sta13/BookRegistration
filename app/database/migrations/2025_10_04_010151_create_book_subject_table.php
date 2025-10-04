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
        Schema::create('book_subject', function (Blueprint $table) {
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('subject_id');

            $table->foreign('book_id')->references('id')->on('books');
            $table->foreign('subject_id')->references('id')->on('subjects');

            $table->primary(['book_id', 'subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_subject');
    }
};
