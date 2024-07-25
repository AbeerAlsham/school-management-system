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
        Schema::create('student_grades', function (Blueprint $table) {
            $table->id();
              $table->foreignId('student_id')->constrained('students')->onDelete('CASCADE')
            ->onUpdate('CASCADE');
            $table->foreignId('class_id')->constrained('study_classes')->onDelete('CASCADE')
            ->onUpdate('CASCADE');
            $table->foreignId('year_id')->constrained('study_years')->onDelete('CASCADE')
            ->onUpdate('CASCADE');
            $table->boolean('is_activation')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_grades');
    }
};
