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
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('departments', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('enrollments', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('graduate_applicants', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('students', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('departments', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('graduate_applicants', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('students', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
