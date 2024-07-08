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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('national_number')->unique();
            $table->string('public_registry_number')->unique();
            $table->string('birthAddress');
            $table->string('birthdate');
            $table->string('registration_place');
            $table->string('registration_number');
            $table->string('religion');
            $table->string('nationality');
            $table->string('Chronic_diseases');
            $table->foreignId('mother_id')->constrained('mothers')->onDelete('CASCADE')
            ->onUpdate('CASCADE');
            $table->foreignId('father_id')->constrained('fathers')->onDelete('CASCADE')
            ->onUpdate('CASCADE');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
