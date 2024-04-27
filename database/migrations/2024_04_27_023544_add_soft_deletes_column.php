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
        Schema::table('school_years', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('majors', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('courses', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('sections', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('document_categories', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('school_years', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('majors', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('courses', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('sections', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('document_categories', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
