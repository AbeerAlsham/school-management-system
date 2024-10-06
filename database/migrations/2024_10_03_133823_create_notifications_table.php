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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('content');
            $table->foreignId('semester_id')->constrained('semesters')->onDelete('CASCADE')
            ->onUpdate('CASCADE');
            $table->foreignId('user_role_id')->constrained('users_roles')->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->boolean('is_read')->default(0);
            $table->string('type_content')->nullable();
            $table->integer('type_content_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
