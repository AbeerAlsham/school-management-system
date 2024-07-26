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
        Schema::create('residential_address', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('type'); //إقامة او مؤقت
            $table->string('isLiveParent');
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
        //
    }
};
