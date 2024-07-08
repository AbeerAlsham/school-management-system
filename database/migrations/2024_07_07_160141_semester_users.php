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
        Schema::create('semester_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_role_id')->constrained('users_roles')->onDelete('CASCADE')
            ->onUpdate('CASCADE');
            $table->foreignId('semester_id')->constrained('semesters')->onDelete('CASCADE')
            ->onUpdate('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
