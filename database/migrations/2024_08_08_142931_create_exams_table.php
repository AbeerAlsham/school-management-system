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
        Schema::create('Exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('semester_id')->constrained('semesters')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('section_id')->nullable()->constrained('sections')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('exam_type_id')->constrained('exam_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('classroom_id')->constrained('classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->string('test_name'); //مثل مذاكرة أولى  سبر 2
            $table->double('total_mark');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marks');
    }
};
