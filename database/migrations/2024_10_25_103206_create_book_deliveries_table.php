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
        Schema::create('book_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_class_id')->constrained('student_classes')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('book_id')->constrained('books')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('is_new_book')->default(true);
            $table->boolean('is_delivered')->default(false);
            $table->boolean('is_returned')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_deliveries');
    }
};
