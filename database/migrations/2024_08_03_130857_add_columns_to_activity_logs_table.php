<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('added_by_ref_id')->unsigned()->nullable();
            $table->unsignedBigInteger('student_ref_id')->unsigned()->nullable();
            $table->string('added_by_employee_id')->nullable();
            $table->string('student_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            //
            $table->dropColumn('added_by_ref_id');
            $table->dropColumn('student_ref_id');
            $table->dropColumn('added_by_employee_id');
            $table->dropColumn('student_id');
        });
    }
};
