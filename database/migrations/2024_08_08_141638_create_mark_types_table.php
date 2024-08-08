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
        Schema::create('mark_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');//مثل امتحان  مذاكرة سبر نشاط 
            $table->double('percentage');// النسبة المثوية التي تمثلها نوع العلامة مثل الامتحان يمثل 50 %
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mark_types');
    }
};
