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
        Schema::create('assignment_teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('semester_user_id')->constrained('semester_users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('class_subject_id')->constrained('class_subject')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('classroom_id')->constrained('classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_teachers');
    }
};
