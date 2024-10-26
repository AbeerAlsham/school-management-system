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
        Schema::create('year_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('books')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('study_year_id')->constrained('study_years')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->integer('book_available_new');
            $table->integer('book_avalilable_old');
            $table->integer('book_delivered_new')->default(0);
            $table->integer('book_delivered_old')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('year_books');
    }
};
