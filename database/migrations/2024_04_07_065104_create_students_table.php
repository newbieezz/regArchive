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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name');
            $table->string('home_address', 500);
            $table->string('city_address', 500);
            $table->string('contact_no');
            $table->string('email');
            $table->string('primary', 500);
            $table->string('primary_sy_graduated');
            $table->string('secondary', 500);
            $table->string('secondary_sy_graduated');
            $table->string('transfer_from', 500);
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
