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
        Schema::create('last_school_infos', function (Blueprint $table) {
            $table->id();
            $table->string('school_name');
            $table->string('school_address');
            $table->string('previous_result');
            $table->json('failed_grades');
            $table->foreignId('student_id')->constrained('students')->onDelete('CASCADE')
            ->onUpdate('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('last_school_infos');
    }
};
