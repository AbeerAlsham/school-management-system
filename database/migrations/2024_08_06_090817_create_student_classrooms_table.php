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
        Schema::create('student_classrooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classroom_id')->constrained('classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('student_class_id')->constrained('student_classes')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('serial_number');//الرقم التسلسلي للطالب ضمن الشعبة 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_classrooms');
    }
};
