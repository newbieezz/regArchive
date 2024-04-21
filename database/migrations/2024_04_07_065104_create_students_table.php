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
            $table->unsignedBigInteger('student_id')->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('home_address', 500)->nullable();
            $table->string('city_address', 500)->nullable();
            $table->string('contact_no')->nullable();
            $table->string('email')->nullable();
            $table->string('gender')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('birth_address', 500)->nullable();
            $table->string('citizenship')->nullable();
            $table->string('religion')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('fathers_name')->nullable();
            $table->string('fathers_occupation')->nullable();
            $table->string('mothers_name')->nullable();
            $table->string('mothers_occupation')->nullable();
            $table->string('guardians_name')->nullable();
            $table->string('guardian_contact')->nullable();
            $table->string('primary', 500)->nullable();
            $table->string('primary_sy')->nullable();
            $table->string('primary_awards', 500)->nullable();
            $table->string('secondary', 500)->nullable();
            $table->string('secondary_sy')->nullable();
            $table->string('secondary_awards', 500)->nullable();
            $table->string('senior_high', 500)->nullable();
            $table->string('senior_high_sy')->nullable();
            $table->string('senior_high_awards', 500)->nullable();
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
