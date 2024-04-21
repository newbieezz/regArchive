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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('school_year_id');
            $table->integer('year_level')->nullable(false);
            $table->integer('semester')->nullable(false);
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('major_id')->nullable();
            $table->string('section')->nullable();
            $table->integer('student_status');
            $table->integer('enrollment_status');
            $table->date('date_enrolled');
            $table->timestamps();

            $table->foreign('student_id')
                ->references('student_id')
                ->on('students')
                ->onDelete('cascade');

            $table->foreign('school_year_id')
                ->references('id')
                ->on('school_years')
                ->onDelete('cascade');

            $table->foreign('department_id')
                ->references('id')
                ->on('departments')
                ->onDelete('cascade');

            $table->foreign('course_id')
                ->references('id')
                ->on('courses')
                ->onDelete('cascade');
                
            $table->foreign('major_id')
                ->references('id')
                ->on('majors')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
