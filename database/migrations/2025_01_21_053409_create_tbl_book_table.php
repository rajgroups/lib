<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_book', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->bigInteger('author_id');
            $table->enum('genre',['fiction','non-fiction','sci-fi','etc']);
            $table->enum('format',['hardcover','paperback','ebook']);
            // enum('hardcover', 'paperback', 'ebook', '')
            $table->integer('price');
            $table->string('string')->unique();
            $table->timestamps();

            // $table->foreign('author_id')->references('id')->on('tbl_author');
              // Foreign key constraints
              $table->foreign('author_id')
              ->references('id')
              ->on('tbl_author')
              ->onDelete('cascade'); // Or 'cascade' based on your needs
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_book');
    }
};
