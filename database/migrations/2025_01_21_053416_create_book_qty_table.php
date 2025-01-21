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
        Schema::create('tbl_book_qty', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('tbl_book')->onDelete('cascade');
            $table->integer('qty')->default(0);
            $table->enum('format', ['hardcover', 'paperback', 'ebook'])->default('hardcover');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_book_qty');
    }
};
