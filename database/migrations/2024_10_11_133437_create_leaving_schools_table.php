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
        Schema::create('leaving_schools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('study_class_id')->constrained('studyClasses')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->date('leave_date');
            $table->string('cause');
            $table->string('document_type');
            $table->integer('document_number');
            $table->date('document_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaving_schools');
    }
};
