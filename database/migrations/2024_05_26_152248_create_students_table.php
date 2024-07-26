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
            $table->string('photo')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('national_number')->unique();//الرقم الوطني
            $table->string('public_registry_number')->unique();//رقم السجل العام
            $table->string('birth_address');//تاريخ الميلاد
            $table->string('birthdate');//عنوان الميلاد
            $table->string('registration_place');//مكان السكن
            $table->string('registration_number');//رقم السكن
            $table->string('religion');//الديانة
            $table->string('nationality');//الجنسية
            $table->string('chronic_diseases')->nullable();// الأمراض المزمنة
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
